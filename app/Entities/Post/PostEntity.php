<?php

namespace App\Entities\Post;

use Carbon\Carbon;

class PostEntity
{
    public int $id;
    public ?int $userId;
    public string $title;
    public string $body;
    public string $slug;
    public string $excerpt;
    public int $views;
    public Carbon $created_at;
    public Carbon $updated_at;
}