<?php

namespace App\Providers;

use App\Services\Photos\IPhotoService;
use App\Services\Photos\PhotoService;
use Illuminate\Support\ServiceProvider;

class PhotoServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(IPhotoService::class, function () {
            $endpoint = config('services.photos.gallery.endpoint');

            return new PhotoService($endpoint);
        });
    }
}
