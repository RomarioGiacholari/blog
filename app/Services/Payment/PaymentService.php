<?php

namespace App\Services\Payment;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Throwable;

class PaymentService implements IPaymentService
{
    public function __construct(string $stripeSecretKey)
    {
        Stripe::setApiKey($stripeSecretKey);
    }

    public function startSession(int $amount): ?object
    {
        $session = null;

        if (null != $amount && $amount > 0) {
            try {
                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items'           => [[
                        'name'     => 'Cup of coffee',
                        'images'   => ['https://images.pexels.com/photos/890515/pexels-photo-890515.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'],
                        'amount'   => $amount,
                        'currency' => 'gbp',
                        'quantity' => 1,
                    ]],
                    'success_url' => config('services.stripe.success_url'),
                    'cancel_url'  => config('services.stripe.cancel_url'),
                ]);
            } catch (Throwable $exception) {
                abort(500, $exception->getMessage());
            }
        }

        return $session;
    }

    public function retrieveSession(string $sessionId): ?object
    {
        $session = null;

        if (null != $sessionId) {
            try {
                $session = Session::retrieve($sessionId);
            } catch (Throwable $exception) {
                abort(500, $exception->getMessage());
            }
        }

        return $session;
    }
}
