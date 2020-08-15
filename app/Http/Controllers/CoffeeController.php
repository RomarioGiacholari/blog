<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Payment\IPaymentService;
use App\ViewModels\Coffee\CancelViewModel;
use App\ViewModels\Coffee\IndexViewModel;
use App\ViewModels\Coffee\ConfirmViewModel;
use App\ViewModels\Coffee\SuccessViewModel;

class CoffeeController extends Controller
{
    private IPaymentService $paymentService;

    public function __construct(IPaymentService $service)
    {
        $this->paymentService = $service ?? null;
    }

    public function index()
    {
        $viewModel = new IndexViewModel;
        $viewModel->pageTitle = "Buy me a cup of coffee";
    
        return view('coffee.index', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['amount' => 'required|numeric|min:1']);

        $requestAmount = (int) $request->amount;
        $stripeAmount = ($requestAmount * 100);

        $session = $this->paymentService->startSession($stripeAmount);
        
        if ($session != null && isset($session->id)) {
            $sessionId = $session->id;

            return redirect(route('coffee.confirm', ['sessionId' => $sessionId]));
        }

        return back();
    }

    public function confirm(string $sessionId)
    {
        $viewModel = new ConfirmViewModel;
        $viewModel->pageTitle = "Confirm Payment";
        $viewModel->stripePublicKey = config('services.stripe.key') ?? null;
        $viewModel->sessionId = null;
        $viewModel->friendlyAmount = null;
        
        if (isset($sessionId)) {
            $viewModel->sessionId = $sessionId;

            $session = $this->paymentService->retrieveSession($sessionId);

            if ($session !== null && isset($session->display_items)) {
                $items = $session->display_items[0];

                if ($items && isset($items->amount) && $items->amount > 0) {
                    $amount = $items->amount;
                    $viewModel->friendlyAmount = ($amount / 100);
                }
            }
        }

        return view('coffee.confirm', ['viewModel' => $viewModel]);
    }

    public function success()
    {
        $viewModel = new SuccessViewModel;
        $viewModel->pageTitle = 'Thank you';
        $viewModel->message = 'Your payment has been successful! Enjoy the rest of your day!';

        return view('coffee.thank-you', ['viewModel' => $viewModel]);
    }

    
    public function cancel()
    {
        $viewModel = new CancelViewModel;
        $viewModel->pageTitle = 'Payment canceled';
        $viewModel->message = 'Your payment was canceled!';

        return view('coffee.cancel', ['viewModel' => $viewModel]);
    }
}
