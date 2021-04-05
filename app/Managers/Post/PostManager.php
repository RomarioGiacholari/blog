<?php

namespace App\Managers\Post;

use App\Adapters\Post\PostAdapter;
use App\Entities\Post\PostEntity;
use App\Post;
use App\Repositories\IPostRepository;

class PostManager implements IPostManager
{
    private IPostRepository $repository;

    public function __construct(IPostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $limit, int $offset = 0, string $orderByColumn = 'created_at', string $direction = 'desc'): array
    {
        $posts = [];
        $postEntities =  $this->repository->get($limit, $offset, $orderByColumn, $direction);

        if (!empty($postEntities)) {
            foreach ($postEntities as $postEntity) {
                $posts[] = PostAdapter::toPost($postEntity);
            }
        }

        return $posts;
    }

    public function getForUser(int $userId, int $limit, int $offset = 0, string $orderByColumn = 'created_at', string $direction = 'desc'): array
    {
        $posts = [];
        $postEntities =  $this->repository->getForUser($userId, $limit, $offset, $orderByColumn, $direction);

        if (!empty($postEntities)) {
            foreach ($postEntities as $postEntity) {
                $posts[] = PostAdapter::toPost($postEntity);
            }
        }

        return $posts;
    }

    public function store(PostEntity $postEntity): ?string
    {
        $postSlug = null;

        if ($postEntity) {
            $postData = PostAdapter::toPostData($postEntity);
            $postSlug = $this->repository->store($postData);
        }

        return $postSlug;
    }

    public function findBy(string $slug): ?Post
    {
        $post = null;

        if (trim($slug) !== '') {
            $postEntity = $this->repository->findBy($slug);

            if ($postEntity !== null) {
                $post = PostAdapter::toPost($postEntity);
            }
        }

        return $post;
    }

    public function update(PostEntity $postEntity, string $slug): bool
    {
        $isSuccess = false;

        if ($postEntity && trim($slug) !== '') {
            $postData = PostAdapter::toPostData($postEntity);
            $isSuccess = $this->repository->update($postData, $slug);
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