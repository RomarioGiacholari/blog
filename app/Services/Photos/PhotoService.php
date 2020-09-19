<?php

namespace App\Services\Photos;

class PhotoService implements IPhotoService
{
    private string $endpoint;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function all() : ?array
    {
        $photos = null;

        if (isset($this->endpoint)) {
            $files = file_get_contents($this->endpoint);

            if ($files != null) {
                $photos = json_decode($files, true);
            }
        }

        return $photos;
    }
}
