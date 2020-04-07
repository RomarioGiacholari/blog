<?php

namespace App\Http\Controllers;

use \stdClass;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;

class CoffeeController extends Controller
{
    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Buy me a cup of coffee";
    
        return view('coffee.index', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['amount' => 'required|numeric|min:1']);

        $stripeSecretKey = config('services.stripe.secret');
        $isSuccess = static::setStripeApiKey($stripeSecretKey);

        if ($isSuccess) {
            $requestAmount = (int) $request->amount;
            $stripeAmount = ($requestAmount * 100);
    
            $session = static::startSession($stripeAmount);
            
            if ($session !== null && $session->id != null) {
                $sessionId = $session->id;
    
                return redirect(route('coffee.confirm', ['sessionId' => $sessionId]));
            }
        }

        return back();
    }

    public function confirm(string $sessionId)
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Confirm Payment";
        $viewModel->stripePublicKey = config('services.stripe.key') ?? null;
        $viewModel->sessionId = null;
        $viewModel->friendlyAmount = null;
        
        if ($sessionId != null) {
            $viewModel->sessionId = $sessionId;

            $stripeSecretKey = config('services.stripe.secret');
            $isSuccess = static::setStripeApiKey($stripeSecretKey);
            $session = Session::retrieve($sessionId);

            if ($isSuccess && $session != null && $session->display_items != null) {
                $items = $session->display_items[0];

                if ($items != null && $items->amount != null && $items->amount > 0) {
                    $amount = $items->amount;
                    $viewModel->friendlyAmount = ($amount / 100);
                }
            }
        }

        return view('coffee.confirm', ['viewModel' => $viewModel]);
    }

    public function success()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Thank you';
        $viewModel->message = 'Your payment has been successful! Enjoy the rest of your day!';

        return view('coffee.thank-you', ['viewModel' => $viewModel]);
    }

    
    public function cancel()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Payment canceled';
        $viewModel->message = 'Your payment was canceled!';

        return view('coffee.cancel', ['viewModel' => $viewModel]);
    }

    private static function setStripeApiKey(string $stripeSecretKey): bool
    {
        $isSuccess = false;

        if ($stripeSecretKey != null) {
            Stripe::setApiKey($stripeSecretKey);
            $isSuccess = true;
        }
        
        return $isSuccess;
    }

    private static function startSession(int $amount): ?object
    {
        $session = null;

        if ($amount != null && $amount > 0) {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                  'name' => 'Cup of coffee',
                  'images' => ['https://images.pexels.com/photos/890515/pexels-photo-890515.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'],
                  'amount' => $amount,
                  'currency' => 'gbp',
                  'quantity' => 1,
                ]],
                'success_url' => 'https://giacholari.com/coffee/success',
                'cancel_url' => 'https://giacholari.com/coffee/cancel',
              ]);
        }
       
        return $session;
    }
}
