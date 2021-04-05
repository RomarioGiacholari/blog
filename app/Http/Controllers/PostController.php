<?php

namespace App\Http\Controllers;

use App\Adapters\Post\PostRequestAdapter;
use App\Managers\Post\IPostManager;
use App\ViewModels\Post\CreateViewModel;
use App\ViewModels\Post\EditViewModel;
use App\ViewModels\Post\IndexViewModel;
use App\ViewModels\Post\ShowViewModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private IPostManager $postManager;

    public function __construct(IPostManager $postManager)
    {
        $this->postManager = $postManager;
        $this->middleware('admin')->except(['show', 'index']);
    }

    public function index(Request $request)
    {
        $offset = 0;
        $limit = config('services.post.pagination.limit');
        $orderBy = static::getOrderByKey($request);
        $orderByDirection = static::getOrderByDirection($request);
        $formattedOrderBy = trim("{$orderBy}|{$orderByDirection}");

        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'Posts';
        $viewModel->orderBy = $formattedOrderBy;
        $viewModel->posts = $this->postManager->get($limit, $offset, $orderBy, $orderByDirection);

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

    private static function getOrderByKey(Request $request): string
    {
        $allowedKeys = ['created_at', 'views'];
        $default = $allowedKeys[0];
        $orderBy = $request->query('orderBy') ?? $default;

        if (!in_array($orderBy, $allowedKeys)) {
            $orderBy = $default;
        }

        return $orderBy;
    }

    private static function getOrderByDirection(Request $request): string
    {
        $allowedKeys = ['desc', 'asc'];
        $default = $allowedKeys[0];
        $direction = $request->query('direction') ?? $default;

        if (!in_array($direction, $allowedKeys)) {
            $direction = $default;
        }

        return $direction;
    }
}
