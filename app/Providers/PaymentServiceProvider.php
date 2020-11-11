<?php

namespace App\Providers;

use App\Services\Payment\IPaymentService;
use App\Services\Payment\PaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(IPaymentService::class, function () {
            $secret = config('services.stripe.secret');

            return new PaymentService($secret);
        });
    }
}
