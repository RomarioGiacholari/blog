<?php

namespace App\Http\Controllers;

use stdClass;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;

class CoffeeController extends Controller
{
    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Buy me a coffee";
    
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
            
            if ($session !== null && is_string($session->id) && $session->id != null) {
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
        
        if (is_string($sessionId) && $sessionId != null) {
            $viewModel->sessionId = $sessionId;
        }

        return view('coffee.confirm', ['viewModel' => $viewModel]);
    }

    public function success()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Thank you';
        $viewModel->message = 'Your payment has been successfull! Enjoy the rest of your day!';

        return view('coffee.thank-you', ['viewModel' => $viewModel]);
    }

    
    public function failure()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Payment declined';
        $viewModel->message = 'Your payment was declined! Something went wrong...';

        return view('coffee.failure', ['viewModel' => $viewModel]);
    }

    private static function setStripeApiKey(string $stripeSecretKey): bool
    {
        $isSuccess = false;

        if (is_string($stripeSecretKey) && $stripeSecretKey != null) {
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
                  'amount' => $amount,
                  'currency' => 'gbp',
                  'quantity' => 1,
                ]],
                'success_url' => 'https://giacholari.com/coffee/success',
                'cancel_url' => 'https://giacholari.com/coffee/failure',
              ]);
        }
       
        return $session;
    }
}
