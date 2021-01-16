<?php

namespace App\Providers;

use App\Services\Post\IPostService;
use App\Services\Post\PostService;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(IPostService::class, PostService::class);
    }
}
