<?php

namespace App\Managers\Post;

use App\Entities\Post\PostEntity;
use App\Post;

interface IPostManager
{
    public function get(int $limit, string $orderByColumn = 'created_at', string $direction = 'desc'): array;

    public function getForUser(int $userId, int $limit, string $orderByColumn = 'created_at', string $direction = 'desc'): array;

    public function store(PostEntity $postEntity): ?string;

    public function findBy(string $slug): ?Post;

    public function update(PostEntity $postEntity, string $slug): bool;

    public function destroy(string $slug): bool;

    public function incrementViews(string $slug): bool;
}
