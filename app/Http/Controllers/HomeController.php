<?php

namespace App\Http\Controllers;

use stdClass;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = auth()->user();
        $postCollection = null;

        if ($currentUser != null && $currentUser->id != null && $currentUser->id > 0) {
            $postCollection = Post::where('user_id', $currentUser->id)
                ->orderBy('created_at', 'desc')->get();
        }

        $viewModel = new stdClass;
        $viewModel->posts = $postCollection;
        $viewModel->pageTitle = 'Home';

        return view('home', ['viewModel' => $viewModel]);
    }
}
