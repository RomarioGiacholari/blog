<?php

namespace App\Console\Commands;

use App\Mail\ContactMe;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AppStatus extends Command
{
    protected $signature = 'app:status';

    protected $description = 'Email admin app status';

    public function handle()
    {
        try {
            $email = config('app.admin.email');
            $endpoint = route('app.status');
            $response = Http::get($endpoint);

            if ($response && $response->status() === 200) {
                $data = $response->body();

                if ($data) {
                    $decodedData = json_decode($data, true);

                    if (!empty($decodedData) && isset($decodedData['status'], $decodedData['code'])) {
                        $messageData = sprintf('Status for %s, Status: %s, Code: %s', config('app.url'), $decodedData['status'], $decodedData['code']);
                        $sendToEmail = $email;
                        $emailFrom = $email;
                        $name = 'Romario Giacholari';
                        $subject = 'App status notification';

                        Mail::to($sendToEmail)
                            ->send(new ContactMe($messageData, $emailFrom, $name, $subject));

                        $this->info('The app status email was sent successfully.');
                    }
                }
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            
            $this->error($exception->getMessage());
        }
    }
}
