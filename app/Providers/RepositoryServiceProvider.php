<?php

namespace App\Providers;

use App\Repositories\IPostRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(IPostRepository::class, PostRepository::class);
    }
}
