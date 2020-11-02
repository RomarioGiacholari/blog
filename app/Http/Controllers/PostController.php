<?php

namespace App\Http\Controllers;

use App\Adapters\Post\PostRequestAdapter;
use App\Services\Post\IPostService;
use App\ViewModels\Post\CreateViewModel;
use App\ViewModels\Post\EditViewModel;
use App\ViewModels\Post\IndexViewModel;
use App\ViewModels\Post\ShowViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    private IPostService $postService;

    public function __construct(IPostService $service)
    {
        $this->postService = $service;
        $this->middleware('admin')->except(['show', 'index']);
    }

    public function index(Request $request)
    {
        $page = $request->query('page') ?? 1;

        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'Posts';
        $viewModel->posts = Cache::remember("posts.page.{$page}", $seconds = 60 * 60 * 24, function () {
            return $this->postService->get(15);
        });

        return view('posts.index', ['viewModel' => $viewModel]);
    }

    public function create()
    {
        $viewModel = new CreateViewModel();
        $viewModel->pageTitle = 'New Post';

        return view('posts.create', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $this->validatePost($request);

        $postEntity = PostRequestAdapter::toPostEntity($request);
        $postSlug = $this->postService->store($postEntity);

        if ($postSlug !== null) {
            $post = $this->postService->findBy($postSlug);

            if ($post !== null) {
                return redirect($post->path());
            }
        }

        return back();
    }

    public function show(string $slug)
    {
        $viewModel            = new ShowViewModel();
        $viewModel->post      = $this->postService->findBy($slug);
        $viewModel->author    = null;
        $viewModel->pageTitle = null;

        if ($viewModel->post !== null) {
            $viewModel->pageTitle = $viewModel->post->title;
            $viewModel->author    = $viewModel->post->creator->name;
        }

        return view('posts.show', ['viewModel' => $viewModel]);
    }

    public function edit(string $slug)
    {
        $viewModel            = new EditViewModel();
        $viewModel->post      = $this->postService->findBy($slug);
        $viewModel->pageTitle = null;

        if ($viewModel->post !== null) {
            $viewModel->pageTitle = $viewModel->post->title;
        }

        return view('posts.edit', ['viewModel' => $viewModel]);
    }

    public function update(Request $request, string $slug)
    {
        $this->validatePost($request, $slug);

        $postEntity = PostRequestAdapter::toPostEntity($request);
        $isSuccess  = $this->postService->update($postEntity, $slug);

        if ($isSuccess) {
            return redirect(route('home.posts'));
        }

        return back();
    }

    public function destroy(string $slug)
    {
        $isSuccess = $this->postService->destroy($slug);

        if ($isSuccess) {
            return redirect(route('home.posts'));
        }

        return back();
    }

    private function validatePost(Request $request, string $slug = ''): void
    {
        $postId = 0;

        if ($slug !== '') {
            $post = $this->postService->findBy($slug);

            if ($post !== null) {
                $postId = $post->id;
            }
        }

        $this->validate($request, [
            'title' => "required|max:25|unique:posts,title,{$postId}",
            'body'  => 'required|max:6000',
        ]);
    }
}
