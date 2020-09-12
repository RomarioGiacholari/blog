<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\ContactMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\ViewModels\Contact\IndexViewModel;

class ContactController extends Controller
{
    public function create()
    {
        $viewModel = new IndexViewModel;
        $viewModel->pageTitle = 'Contact me';

        return view('contact.create', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $isSuccess = false;
        $message = null;

        $this->validateEmail($request);

        if ($request->answer == 4) {
            $sendToEmail = config('app.admin_email');
            $subject = $request->subject;
            $messageData = $request->message;
            $emailFrom = $request->email;
            $name = $request->name;

            try {
                Mail::to($sendToEmail)
                    ->send(new ContactMe($messageData, $emailFrom, $name, $subject));

                $isSuccess = true;
                $message = 'Email sent! Thank you for reaching out. I should shortly get back to you with a reply.';
            } catch (Exception $ex) {
                $message = $ex->getMessage();
            }

            $data = [
                'isSuccess' => $isSuccess,
                'message' => $message
            ];

            return response($data , 200);
        }
    }

    private function validateEmail($request) : void
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'subject' => 'required|max:100',
            'message' => 'required|max:500',
            'answer' => 'required|integer|min:4|max:4'
        ]);
    }
}
