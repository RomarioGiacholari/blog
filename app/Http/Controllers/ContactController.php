<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\ViewModels\Contact\IndexViewModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'Contact me';

        return view('contact.create', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $data = $this->validateEmailRequest($request);
        $status = 500;
        $isSuccess = false;
        $message = 'Something went wrong...';
        $headers = ['Content-Type' => 'application/json'];

        $appUrl = config('app.url');
        $environment = app()->environment();
        $sendToEmail = config('app.admin.email');
        $subject = "[{$environment}][{$appUrl}][Support]";
        $name = $data['name'];
        $email = $data['email'];
        $messageData = $data['message'];

        try {
            Mail::to($sendToEmail)
                ->send(new ContactMe($messageData, $email, $name, $subject));

            $isSuccess = true;
            $message = 'Email sent! Thank you for reaching out. I should shortly get back to you with a reply.';
            $status = 200;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        $data = [
            'isSuccess' => $isSuccess,
            'message'   => $message,
        ];

        return response($data, $status, $headers);
    }

    private function validateEmailRequest(Request $request): array
    {
        return $this->validate($request, [
            'name'    => 'required|max:50',
            'email'   => 'required|email:rfc,dns',
            'message' => 'required|max:1000',
            'answer'  => 'required|integer|in:4',
            'privacy' => 'required|accepted'
        ]);
    }
}
