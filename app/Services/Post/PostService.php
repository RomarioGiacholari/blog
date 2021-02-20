<?php

namespace App\Services\Post;

use App\Entities\Post\PostEntity;
use App\Post;
use App\Repositories\IPostRepository;
use Illuminate\Contracts\Pagination\Paginator;

class PostService implements IPostService
{
    private IPostRepository $repository;

    public function __construct(IPostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $perPage, string $orderByColumn = 'created_at', string $direction = 'desc'): ?Paginator
    {
        return $this->repository->get($perPage, $orderByColumn, $direction);
    }

    public function store(PostEntity $postEntity): ?string
    {
        $postSlug = null;

        if ($postEntity) {
            $postSlug = $this->repository->store($postEntity);
        }

        return $postSlug;
    }

    public function findBy(string $slug): ?Post
    {
        $post = null;

        if (trim($slug) !== '') {
            $post = $this->repository->findBy($slug);
        }

        return $post;
    }

    public function update(PostEntity $postEntity, string $slug): bool
    {
        $isSuccess = false;

        if ($postEntity && trim($slug) !== '') {
            $isSuccess = $this->repository->update($postEntity, $slug);
        }

        return $isSuccess;
    }

    public function destroy(string $slug): bool
    {
        $isSuccess = false;

        if (trim($slug) !== '') {
            $isSuccess  = $this->repository->destroy($slug);
        }

        return $isSuccess;
    }

    public function incrementViews(string $slug): bool
    {
        $isSuccess = false;

        if (trim($slug) !== '') {
            $isSuccess = $this->repository->incrementViews($slug);
        }

        return $isSuccess;
    }
}