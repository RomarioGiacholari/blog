<?php

namespace App\Services\Photos;

use Throwable;

class PhotoService implements IPhotoService
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
                $files = file_get_contents($this->endpoint);

                if ($files) {
                    $photos = json_decode($files, true);
                }
            } catch (Throwable $exception) {
                abort(500, $exception->getMessage());
            }
        }

        return $photos;
    }
}
