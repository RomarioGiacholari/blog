<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';
    protected $namespace;

    public function boot(): void
    {
        $this->configureRateLimiting();

        parent::boot();
    }

    public function map(): void
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('global', function (Request $request) {
            $maxAttempts = 30;
            $ip = $request->ip();

            return Limit::perMinute($maxAttempts)->by($ip);
        });
    }
}
