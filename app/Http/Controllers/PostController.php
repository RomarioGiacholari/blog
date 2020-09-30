<?php

namespace App\Http\Controllers;

use App\Post;
use App\ViewModels\Post\CreateViewModel;
use App\ViewModels\Post\EditViewModel;
use App\ViewModels\Post\IndexViewModel;
use App\ViewModels\Post\ShowViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['show', 'index']);
    }

    public function index(Request $request)
    {
        $page = $request->query('page') ?? 1;

        $viewModel            = new IndexViewModel();
        $viewModel->pageTitle = 'Posts';
        $viewModel->posts     = Cache::remember("posts.page.{$page}", $minutes = 60 * 24, function () {
            $paginator = Post::with('creator')->latest()->paginate(15);

            if ($paginator && !$paginator->isEmpty()) {
                return $paginator;
            }

            return null;
        });

        return view('posts.index', ['viewModel' => $viewModel]);
    }

    public function create()
    {
        $viewModel            = new CreateViewModel();
        $viewModel->pageTitle = 'New Post';

        return view('posts.create', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $this->validatePost($request);

        $attributes = [
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
            'slug'    => $request->input('title'),
            'excerpt' => $request->input('body'),
        ];

        $user = auth()->user();
        $post = $user->posts()->create($attributes);

        return redirect($post->path());
    }

    public function show(Post $post)
    {
        $viewModel            = new ShowViewModel();
        $viewModel->post      = $post;
        $viewModel->author    = null;
        $viewModel->pageTitle = null;

        if (isset($post->title, $post->creator, $post->creator->name)) {
            $viewModel->pageTitle = $post->title;
            $viewModel->author    = $post->creator->name;
        }

        return view('posts.show', ['viewModel' => $viewModel]);
    }

    public function edit(Post $post)
    {
        $viewModel            = new EditViewModel();
        $viewModel->post      = $post;
        $viewModel->pageTitle = null;

        if (isset($post->title)) {
            $viewModel->pageTitle = $post->title;
        }

        return view('posts.edit', ['viewModel' => $viewModel]);
    }

    public function update(Request $request, Post $post)
    {
        $this->validatePost($request, $post->id);

        $attributes = [
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
            'slug'    => $request->input('title'),
            'excerpt' => $request->input('body'),
        ];

        $post->fill($attributes);
        $post->save();

        return redirect(route('home.posts'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('home.posts'));
    }

    private function validatePost(Request $request, int $postId = 0)
    {
        $this->validate($request, [
            'title' => "required|max:25|unique:posts,title,{$postId}",
            'body'  => 'required|max:6000',
        ]);
    }
}
