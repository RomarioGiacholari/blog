<?php

namespace App\Http\Controllers;

use \stdClass;
use Illuminate\Http\Request;
use App\Services\Payment\IPaymentService;

class CoffeeController extends Controller
{
    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Buy me a cup of coffee";
    
        return view('coffee.index', ['viewModel' => $viewModel]);
    }

    public function store(Request $request, IPaymentService $paymentService)
    {
        $this->validate($request, ['amount' => 'required|numeric|min:1']);

        $requestAmount = (int) $request->amount;
        $stripeAmount = ($requestAmount * 100);

        $session = $paymentService->startSession($stripeAmount);
        
        if ($session !== null && $session->id != null) {
            $sessionId = $session->id;

            return redirect(route('coffee.confirm', ['sessionId' => $sessionId]));
        }

        return back();
    }

    public function confirm(string $sessionId, IPaymentService $paymentService)
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Confirm Payment";
        $viewModel->stripePublicKey = config('services.stripe.key') ?? null;
        $viewModel->sessionId = null;
        $viewModel->friendlyAmount = null;
        
        if ($sessionId != null) {
            $viewModel->sessionId = $sessionId;

            $session = $paymentService->retrieveSession($sessionId);

            if ($session != null && $session->display_items != null) {
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
}
