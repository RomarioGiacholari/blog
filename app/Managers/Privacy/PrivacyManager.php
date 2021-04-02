<?php

namespace App\Managers\Privacy;

use Exception;
use Illuminate\Support\Facades\Http;

class PrivacyManager implements IPrivacyManager
{
    private string $endpoint;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function get(): ?array
    {
        $decodedPrivacy = null;

        try {
            $response = Http::get($this->endpoint);

            if ($response && $response->status() === 200) {
                $data = $response->body();

                if ($data) {
                    $decodedPrivacy = json_decode($data, true);
                }
            }
        } catch (Exception $exception) {
            abort($exception->getMessage(), 500);
        }

        return $decodedPrivacy;
    }
}
