<?php

namespace App\Http\Controllers;

use App\Adapters\Order\OrderByAdapter;
use App\Adapters\Pagination\PaginationRequestAdapter;
use App\Http\Middleware\Administrator;
use App\Managers\Post\IPostManager;
use App\User;
use App\ViewModels\Home\EpisodesViewModel;
use App\ViewModels\Home\PostsViewModel;
use App\ViewModels\Pagination\PaginationViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private IPostManager $postManager;

    public function __construct(IPostManager $postManager)
    {
        $this->postManager = $postManager;
        $this->middleware(Administrator::class);
    }

    public function posts(Request $request)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $orderBy = OrderByAdapter::toKey($request);
        $direction = OrderByAdapter::toDirection($request);
        $internalOrderByKey = OrderByAdapter::toInternalKey($orderBy);

        $limit = config('services.post.pagination.limit');
        $page = PaginationRequestAdapter::getPage($request);
        $offset = ($page * $limit) - $limit;
        $itemsCount = $this->postManager->countForUser($currentUser->id);
        $totalPages = 1;

        if ($itemsCount > 0) {
            $totalPages = ceil(($itemsCount / $limit));
        }

        $viewModel = new PostsViewModel();
        $viewModel->pageTitle = 'Home | Posts';
        $viewModel->posts = $this->postManager->getForUser($currentUser->id, $limit, $offset, $internalOrderByKey, $direction);
        $viewModel->orderBy = trim("{$orderBy}|{$direction}");
        $viewModel->pagination = new PaginationViewModel($page, $totalPages);

        return view('home.posts', ['viewModel' => $viewModel]);
    }

    public function episodes()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
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
