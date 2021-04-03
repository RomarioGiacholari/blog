<?php

namespace App\Http\Controllers;

use App\Managers\Post\IPostManager;
use App\User;
use App\ViewModels\Home\EpisodesViewModel;
use App\ViewModels\Home\PostsViewModel;

class HomeController extends Controller
{
    private IPostManager $postManager;

    public function __construct(IPostManager $postManager)
    {
        $this->postManager = $postManager;
        $this->middleware('admin');
    }

    public function posts()
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        $limit = config('services.post.pagination.limit');
        $postList = [];

        if ($currentUser && isset($currentUser->id) && $currentUser->id > 0) {
            $postList = $this->postManager->getForUser($currentUser->id, $limit);
        }

        $viewModel = new PostsViewModel();
        $viewModel->posts = $postList;
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
