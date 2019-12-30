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

        $stripeSecret = config('services.stripe.secret');
        $stripeKey = $stripeSecret;
        Stripe::setApiKey($stripeKey);

        $amount = ($request->amount * 100);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'name' => 'Cup of coffee',
              'amount' => $amount,
              'currency' => 'gbp',
              'quantity' => 1,
            ]],
            'success_url' => 'https://giacholari.com/coffee/success',
            'cancel_url' => 'https://giacholari.com/coffee',
          ]);

        $sessionId = $session->id;

        return redirect(route('coffee.confirm', ['sessionId' => $sessionId]));
    }

    public function confirm(string $sessionId)
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Confirm Payment";
        $viewModel->sessionId = $sessionId;
        $viewModel->stripePublicKey = config('services.stripe.key') ?? null;

        return view('coffee.confirm', ['viewModel' => $viewModel]);
    }

    public function success()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Thank you';
        $viewModel->message = 'Your payment has been successfull! Enjoy the rest of your day!';

        return view('coffee.thank-you', ['viewModel' => $viewModel]);
    }
}
