<?php

namespace App\Console\Commands;

use App\Mail\ContactMe;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AppStatus extends Command
{
    protected $signature = 'app:status';

    protected $description = 'Email admin app status';

    public function handle()
    {
        try {
            $email    = config('app.admin_email');
            $endpoint = route('app.status');
            $response = json_decode(file_get_contents($endpoint), true);

            $messageData = sprintf('Status for %s, Status: %s, Code: %s', config('app.url'), $response['status'], $response['code']);
            $sendToEmail = $email;
            $emailFrom   = $email;
            $name        = 'Romario Giacholari';
            $subject     = 'App status notification';

            Mail::to($sendToEmail)
                ->send(new ContactMe($messageData, $emailFrom, $name, $subject));

            $this->info('The app status email was sent successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());

            Log::error($exception->getMessage());
        }
    }
}
