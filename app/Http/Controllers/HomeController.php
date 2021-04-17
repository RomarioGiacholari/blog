<?php

namespace App\Http\Controllers;

use App\Adapters\Pagination\PaginationRequestAdapter;
use App\Managers\Post\IPostManager;
use App\User;
use App\ViewModels\Home\EpisodesViewModel;
use App\ViewModels\Home\PostsViewModel;
use App\ViewModels\Pagination\PaginationViewModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private IPostManager $postManager;

    public function __construct(IPostManager $postManager)
    {
        $this->postManager = $postManager;
        $this->middleware('admin');
    }

    public function posts(Request $request)
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        $limit = config('services.post.pagination.limit');
        $page = PaginationRequestAdapter::getPage($request);
        $offset = ($page * $limit) - $limit;
        $itemsCount = $this->postManager->countForUser($currentUser->id);
        $totalPages = 1;

        if ($itemsCount > 0) {
            $totalPages = ceil(($itemsCount / $limit));
        }

        $viewModel = new PostsViewModel();
        $viewModel->posts = $this->postManager->getForUser($currentUser->id, $limit, $offset);
        $viewModel->pageTitle = 'Home | Posts';
        $viewModel->pagination = new PaginationViewModel($page, $totalPages);

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
