<?php

namespace App\Providers;

use App\Managers\Payment\IPaymentManager;
use App\Managers\Payment\PaymentManager;
use App\Managers\Photos\IPhotoManager;
use App\Managers\Photos\PhotoManager;
use App\Managers\Post\IPostManager;
use App\Managers\Post\PostManager;
use App\Managers\Privacy\IPrivacyManager;
use App\Managers\Privacy\PrivacyManager;
use Illuminate\Support\ServiceProvider;

class ManagerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(IPaymentManager::class, function () {
            $secret = config('services.stripe.secret');

            return new PaymentManager($secret);
        });

        $this->app->singleton(IPhotoManager::class, function () {
            $endpoint = config('services.photos.gallery.endpoint');

            return new PhotoManager($endpoint);
        });

        $this->app->singleton(IPrivacyManager::class, function () {
            $endpoint = config('services.privacy.endpoint');

            return new PrivacyManager($endpoint);
        });

        $this->app->singleton(IPostManager::class, PostManager::class);
    }
}
