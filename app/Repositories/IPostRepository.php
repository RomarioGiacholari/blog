<?php

namespace App\Repositories;

use App\Entities\Post\PostEntity;
use App\Post;
use Illuminate\Contracts\Pagination\Paginator;

interface IPostRepository
{
    public function get(int $perPage, string $orderByColumn = 'created_at', string $direction = 'desc'): ?Paginator;

    public function store(PostEntity $postEntity): ?string;

    public function findBy(string $slug): ?Post;

    public function update(PostEntity $postEntity, string $slug): bool;

    public function destroy(string $slug): bool;
}
