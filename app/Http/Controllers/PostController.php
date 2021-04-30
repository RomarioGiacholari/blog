<?php

namespace App\Http\Controllers;

use App\Adapters\Order\OrderByAdapter;
use App\Adapters\Pagination\PaginationRequestAdapter;
use App\Adapters\Post\PostRequestAdapter;
use App\Http\Middleware\Administrator;
use App\Managers\Post\IPostManager;
use App\ViewModels\Pagination\PaginationViewModel;
use App\ViewModels\Post\CreateViewModel;
use App\ViewModels\Post\EditViewModel;
use App\ViewModels\Post\IndexViewModel;
use App\ViewModels\Post\ShowViewModel;
use Illuminate\Http\Request;
use InvalidArgumentException;

class PostController extends Controller
{
    private IPostManager $postManager;

    public function __construct(IPostManager $postManager)
    {
        $this->postManager = $postManager ?? throw new InvalidArgumentException(IPostManager::class);
        $this->middleware(Administrator::class)->except(['show', 'index']);
    }

    public function index(Request $request)
    {
        $orderBy = OrderByAdapter::toKey($request);
        $direction = OrderByAdapter::toDirection($request);
        $internalOrderByKey = OrderByAdapter::toInternalKey($orderBy);

        $limit = (int) config('services.post.pagination.limit');
        $page = PaginationRequestAdapter::getPage($request);
        $offset = (int) (($page * $limit) - $limit);
        $itemsCount = $this->postManager->count();
        $totalPages = 1;

        if ($itemsCount > 0) {
            $totalPages = ceil(($itemsCount / $limit));
        }

        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'Posts';
        $viewModel->orderBy = trim("{$orderBy}|{$direction}");
        $viewModel->posts = $this->postManager->get($limit, $offset, $internalOrderByKey, $direction);
        $viewModel->pagination = new PaginationViewModel($page, $totalPages);

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

        $redirectPath = back();
        $postEntity = PostRequestAdapter::toPostEntity($request);
        $postSlug = $this->postManager->store($postEntity);

        if ($postSlug !== null) {
            $post = $this->postManager->findBy($postSlug);

            if ($post !== null) {
                $redirectPath = redirect($post->path());
            }
        }

        return $redirectPath;
    }

    public function show(string $slug)
    {
        $viewModel = new ShowViewModel();
        $viewModel->post = $this->postManager->findBy($slug);
        $viewModel->author = null;
        $viewModel->pageTitle = null;

        if ($viewModel->post !== null && isset($viewModel->post->creator)) {
            $viewModel->pageTitle = $viewModel->post->title;
            $viewModel->author = $viewModel->post->creator->name;

            $_ = $this->postManager->incrementViews($slug);
        }

        return view('posts.show', ['viewModel' => $viewModel]);
    }

    public function edit(string $slug)
    {
        $viewModel = new EditViewModel();
        $viewModel->post = $this->postManager->findBy($slug);
        $viewModel->pageTitle = null;

        if ($viewModel->post !== null) {
            $viewModel->pageTitle = $viewModel->post->title;
        }

        return view('posts.edit', ['viewModel' => $viewModel]);
    }

    public function update(Request $request, string $slug)
    {
        $redirectPath = back();
        $this->validatePost($request, $slug);

        $postEntity = PostRequestAdapter::toPostEntity($request);
        $isSuccess = $this->postManager->update($postEntity, $slug);

        if ($isSuccess) {
            $redirectPath = redirect(route('home.posts'));
        }

        return $redirectPath;
    }

    public function destroy(string $slug)
    {
        $redirectPath = back();
        $isSuccess = $this->postManager->destroy($slug);

        if ($isSuccess) {
            $redirectPath = redirect(route('home.posts'));
        }

        return $redirectPath;
    }

    private function validatePost(Request $request, string $slug = ''): void
    {
        $postId = 0;

        if ($slug !== '') {
            $post = $this->postManager->findBy($slug);

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
