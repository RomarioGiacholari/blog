<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMe extends Mailable
{
    use Queueable;
    use SerializesModels;

    public string $messageData;
    public string $email;
    public string $name;
    public $subject;

    public function __construct(string $message, string $email, string $name, string $subject)
    {
        $this->messageData = $message;
        $this->email       = $email;
        $this->name        = $name;
        $this->subject     = $subject;
    }

    public function build()
    {
        $subject = $this->subject ?? 'Not specified';
        $view    = 'emails.contact';

        return $this->subject($subject)->view($view);
    }
}
