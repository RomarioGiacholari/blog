<?php

namespace App\Providers;

use App\Services\Privacy\IPrivacyService;
use App\Services\Privacy\PrivacyService;
use Illuminate\Support\ServiceProvider;

class PrivacyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(IPrivacyService::class, function () {
            $endpoint = config('services.privacy.endpoint');

            return new PrivacyService($endpoint);
        });
    }
}
