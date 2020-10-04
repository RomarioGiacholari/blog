<?php

namespace App\Providers;

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
    }
}
