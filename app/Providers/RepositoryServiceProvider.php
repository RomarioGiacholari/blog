<?php

namespace App\Providers;

use App\Repositories\Post\IPostRepository;
use App\Repositories\Post\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(IPostRepository::class, PostRepository::class);
    }
}
