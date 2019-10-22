<?php

namespace App\Http\Controllers;

use stdClass;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewModel = new stdClass;
        $postsCollection = Post::with('creator')->latest()->paginate(15) ?? null;
        $viewModel->posts = $postsCollection;
        $viewModel->pageTitle = 'Posts';

        return view('posts.index', ['viewModel' => $viewModel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validatePost($request);

        $attributes = [
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->title,
            'excerpt' => $request->body,
        ];

        $post = auth()->user()->posts()->create($attributes);

        return redirect($post->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $viewModel = new stdClass;
        $viewModel->post = $post ?? null;
        $viewModel->pageTitle = '';

        if ($post !== null)
        {
            $viewModel->pageTitle = $post->title;
        }

        return view('posts.show', ['viewModel' => $viewModel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $viewModel = new stdClass;
        $viewModel->post = $post ?? null;
        $viewModel->pageTitle = '';

        if ($post !== null)
        {
            $viewModel->pageTitle = $post->title;
        }
        
        return view('posts.edit', ['viewModel' => $viewModel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validatePost($request);

        $attributes = [
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->title,
            'excerpt' => $request->body,
        ];

        $post->update($attributes);

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back();
    }

    private function validatePost($request)
    {
        $this->validate($request, [
            'title' => 'required|max:20',
            'body' => 'required',
        ]);
    }
}
