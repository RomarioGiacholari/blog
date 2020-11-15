<?php

namespace App\Providers;

use App\Services\Post\IPostService;
use App\Services\Post\PostService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Rollbar\Laravel\RollbarServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Paginator::useBootstrap();

        if (!$this->app->isLocal()) {
            URL::forceScheme('https');
        }

        $this->app->singleton(IPostService::class, PostService::class);
    }

    public function register(): void
    {
        if (!$this->app->isLocal()) {
            $this->app->register(RollbarServiceProvider::class);
        }

        if ($this->app->isLocal()) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
