<?php

namespace App\Http\Controllers;

use stdClass;
use Exception;
use App\Mail\ContactMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        $viewModel = new stdClass;
        $viewModel->isSuccess = request('isSuccess') ?? false;
        $viewModel->message = request('message') ?? null;
        $viewModel->pageTitle = 'Contact me';

        return view('contact.create', ['viewModel' => $viewModel]);
    }

    public function store(Request $request)
    {
        $isValid = $this->validateEmail($request);
        $isSuccess = false;
        $message = null;

        if ($isValid && $request->answer == 4)
        {
            $sendToEmail = config('app.admin_Email');
            $subject = $request->subject;
            $messageData = $request->message;
            $emailFrom = $request->email;
            $name = $request->name;

            try 
            {
                Mail::to($sendToEmail)
                    ->send(new ContactMe($messageData, $emailFrom, $name, $subject));

                $isSuccess = true;
                $message = 'Email sent!';
            } 
            catch (Exception $ex) 
            {
                $isSuccess = false;
                $message = $ex->getMessage();
            }

            return redirect(route(
                'contact.create',
                [
                    'isSuccess' => $isSuccess,
                    'message' => $message
                ]
            ));
        }

        return back();
    }

    private function validateEmail($request)
    {
        $isValid = false;

        if ($request !== null) {
            $data = $this->validate($request, [
                'name' => 'required|max:50',
                'email' => 'required|email',
                'subject' => 'required|max:100',
                'message' => 'required|max:500',
                'answer' => 'required|integer|min:4|max:4'
            ]);
            
            if ($data !== null) 
            {
                $isValid = true;
            }
        }

        return $isValid;
    }
}
