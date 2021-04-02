<?php

namespace App\Managers\Photos;

use Exception;
use Illuminate\Support\Facades\Http;

class PhotoManager implements IPhotoManager
{
    private string $endpoint;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function all(): ?array
    {
        $photos = null;

        if (isset($this->endpoint)) {
            try {
                $response = Http::get($this->endpoint);

                if ($response && $response->status() === 200) {
                    $data = $response->body();

                    if ($data) {
                        $photos = json_decode($data, true);
                    }
                }
            } catch (Exception $exception) {
                abort(500, $exception->getMessage());
            }
        }

        return $photos;
    }
}
