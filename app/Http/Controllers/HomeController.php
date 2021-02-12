<?php

namespace App\Http\Controllers;

use App\Post;
use App\ViewModels\Home\EpisodesViewModel;
use App\ViewModels\Home\PostsViewModel;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function posts()
    {
        $currentUser = auth()->user();
        $postCollection = null;

        if ($currentUser && isset($currentUser->id) && $currentUser->id > 0) {
            $postCollection = Post::query()->where('user_id', $currentUser->id)
                ->orderBy('created_at', 'desc')->get();
        }

        $viewModel = new PostsViewModel();
        $viewModel->posts = $postCollection;
        $viewModel->pageTitle = 'Home | Posts';

        return view('home.posts', ['viewModel' => $viewModel]);
    }

    public function episodes()
    {
        $currentUser = auth()->user();
        $episodeCollection = null;

        if ($currentUser && isset($currentUser->id) && $currentUser->id > 0) {
            $episodeCollection = $currentUser->podcasts()->first()->episodes()->orderBy('created_at', 'desc')->get();
        }

        $viewModel = new EpisodesViewModel();
        $viewModel->episodes = $episodeCollection;
        $viewModel->pageTitle = 'Home | Episodes';

        return view('home.episodes', ['viewModel' => $viewModel]);
    }
}
