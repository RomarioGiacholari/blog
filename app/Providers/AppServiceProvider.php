<?php

namespace App\Providers;

use App\Repositories\IPostRepository;
use App\Services\Post\IPostService;
use App\Services\Post\PostService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Rollbar\Laravel\RollbarServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->isLocal()) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();

        $this->app->singleton(IPostService::class, PostService::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!app()->isLocal()) {
            $this->app->register(RollbarServiceProvider::class);
        }

        if ($this->app->isLocal()) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
