<?php

namespace App\Providers;

use App\Services\Photos\IPhotoService;
use App\Services\Photos\PhotoService;
use Illuminate\Support\ServiceProvider;

class PhotoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(IPhotoService::class, function () {
            return new PhotoService(config('services.photos.gallery.endpoint'));
        });
    }
}
