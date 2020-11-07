<?php

namespace App\Services\Privacy;

use Exception;

class PrivacyService implements IPrivacyService
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
            $privacyJson = file_get_contents($this->endpoint);

            if ($privacyJson) {
                $decodedPrivacy = json_decode($privacyJson, true);
            }
        } catch (Exception $exception) {
            abort($exception->getMessage(), 500);
        }

        return $decodedPrivacy;
    }
}
