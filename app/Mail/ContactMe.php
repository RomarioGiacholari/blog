<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMe extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;
    public $email;
    public $name;
    public $subject;

    public function __construct(string $message, string $email, string $name, string $subject)
    {
        $this->messageData = $message;
        $this->email = $email;
        $this->name = $name;
        $this->subject = $subject;
    }

    public function build()
    {
        $subject = $this->subject ?? 'Not specified';

        return $this->subject($subject)->view('emails.contact');
    }
}
