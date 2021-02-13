<?php

namespace App\Services\Post;

use App\Entities\Post\PostEntity;
use App\Post;
use Illuminate\Contracts\Pagination\Paginator;

interface IPostService
{
    public function get(int $perPage, string $orderByColumn = 'created_at', string $direction = 'desc'): ?Paginator;

    public function store(PostEntity $postEntity): ?string;

    public function findBy(string $slug): ?Post;

    public function update(PostEntity $postEntity, string $slug): bool;

    public function destroy(string $slug): bool;

    public function incrementViews(string $slug): bool;
}
