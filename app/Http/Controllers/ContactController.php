<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\ViewModels\Contact\IndexViewModel;
use Exception;
use Illuminate\Http\Request;
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
        $isSuccess = false;
        $message = null;
        $headers = ['Content-Type' => 'application/json'];
        $status = 500;

        $this->validateEmail($request);

        $appUrl = config('app.url');
        $environment = app()->environment();
        $sendToEmail = config('app.admin_email');
        $subject = "[{$environment}][{$appUrl}][Support]";
        $messageData = $request->input('message');
        $emailFrom = $request->input('email');
        $name = $request->input('name');

        try {
            Mail::to($sendToEmail)
                ->send(new ContactMe($messageData, $emailFrom, $name, $subject));

            $isSuccess = true;
            $message = 'Email sent! Thank you for reaching out. I should shortly get back to you with a reply.';
            $status = 200;
        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }

        $data = [
            'isSuccess' => $isSuccess,
            'message'   => $message,
        ];

        return response($data, $status, $headers);
    }

    private function validateEmail($request): void
    {
        $this->validate($request, [
            'name'    => 'required|max:50',
            'email'   => 'required|email',
            'message' => 'required|max:1000',
            'answer'  => 'required|integer|in:4',
            'privacy' => 'required|accepted'
        ]);
    }
}
