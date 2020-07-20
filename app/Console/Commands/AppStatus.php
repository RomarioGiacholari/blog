<?php

namespace App\Console\Commands;

use Exception;
use App\Mail\ContactMe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AppStatus extends Command
{
    protected $signature = 'app:status';

    protected $description = 'Email admin app status';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try 
        {   
            $endpoint = route('app.status');
            $response = json_decode(file_get_contents($endpoint), true);
            $appName = config('app.name');

            $messageData = "Status for {$appName}, status: {$response['status']}, code: {$response['code']}";
            $sendToEmail = config('app.admin_email');
            $emailFrom = 'giacholari.com';
            $name = 'Romario Giacholari';
            $subject = 'App status notification';

            Mail::to($sendToEmail)
                ->send(new ContactMe($messageData, $emailFrom, $name, $subject));
        }
        catch (Exception $exception)
        {
            Log::error($exception->getMessage());
        }
    }
}
