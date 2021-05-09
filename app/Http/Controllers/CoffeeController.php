<?php

namespace App\Http\Controllers;

use App\Managers\Payment\IPaymentManager;
use App\ViewModels\Coffee\CancelViewModel;
use App\ViewModels\Coffee\ConfirmViewModel;
use App\ViewModels\Coffee\IndexViewModel;
use App\ViewModels\Coffee\SuccessViewModel;
use Illuminate\Http\Request;
use InvalidArgumentException;
use function count;

class CoffeeController extends Controller
{
    private IPaymentManager $paymentManager;

    public function __construct(IPaymentManager $paymentManager)
    {
        $this->paymentManager = $paymentManager ?? throw new InvalidArgumentException(IPaymentManager::class);
    }

    public function index()
    {
        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'Buy me a cup of coffee';

        return view('coffee.index', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, ['amount' => 'required|numeric|min:1|max:5']);
        $requestAmount = (float) $data['amount'];
        $stripeAmount = ($requestAmount * 100);
        $session = $this->paymentManager->startSession($stripeAmount);

        if ($session !== null  && isset($session->id)) {
            $sessionId = $session->id;

            return redirect(route('coffee.confirm', ['sessionId' => $sessionId]));
        }

        return back();
    }

    public function confirm(string $sessionId)
    {
        $viewModel = new ConfirmViewModel();
        $viewModel->pageTitle = 'Confirm Payment';
        $viewModel->stripePublicKey = config('services.stripe.key') ?? null;
        $viewModel->sessionId = $sessionId;
        $viewModel->friendlyAmount = null;

        $session = $this->paymentManager->retrieveSession($sessionId);

        if ($session !== null && isset($session->display_items) && count($session->display_items) > 0) {
            $items = $session->display_items[0];

            if ($items && isset($items->amount) && $items->amount > 0) {
                $amount = $items->amount;
                $viewModel->friendlyAmount = ($amount / 100);
            }
        }

        return view('coffee.confirm', ['viewModel' => $viewModel]);
    }

    public function success()
    {
        $viewModel = new SuccessViewModel();
        $viewModel->pageTitle = 'Thank you';
        $viewModel->message = 'Your payment has been successful. Enjoy the rest of your day.';

        return view('coffee.thank-you', ['viewModel' => $viewModel]);
    }

    public function cancel()
    {
        $viewModel = new CancelViewModel();
        $viewModel->pageTitle = 'Payment canceled';
        $viewModel->message = 'Your payment was canceled.';

        return view('coffee.cancel', ['viewModel' => $viewModel]);
    }
}
