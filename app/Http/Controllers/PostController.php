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
            return Post::with('creator')->latest()->paginate(15) ?? null;
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
            'title'   => $request->title,
            'body'    => $request->body,
            'slug'    => $request->title,
            'excerpt' => $request->body,
        ];

        $user = auth()->user();
        $post = $user->posts()->create($attributes);

        return redirect($post->path());
    }

    public function show(Post $post)
    {
        $viewModel            = new ShowViewModel();
        $viewModel->post      = null;
        $viewModel->author    = null;
        $viewModel->pageTitle = null;

        if ($post && isset($post->title, $post->creator, $post->creator->name)) {
            $viewModel->post      = $post;
            $viewModel->pageTitle = $post->title;
            $viewModel->author    = $post->creator->name;
        }

        return view('posts.show', ['viewModel' => $viewModel]);
    }

    public function edit(Post $post)
    {
        $viewModel            = new EditViewModel();
        $viewModel->post      = null;
        $viewModel->pageTitle = null;

        if ($post && isset($post->title)) {
            $viewModel->post      = $post;
            $viewModel->pageTitle = $post->title;
        }

        return view('posts.edit', ['viewModel' => $viewModel]);
    }

    public function update(Request $request, Post $post)
    {
        $this->validatePost($request, $post->id);

        $attributes = [
            'title'   => $request->title,
            'body'    => $request->body,
            'slug'    => $request->title,
            'excerpt' => $request->body,
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
            'title' => "required|max:20|unique:posts,title,{$postId}",
            'body'  => 'required|max:1500',
        ]);
    }
}
