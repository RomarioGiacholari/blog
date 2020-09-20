<?php

namespace App\Services\Photos;

use Illuminate\Support\Facades\Log;

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

                if (null != $files) {
                    $photos = json_decode($files, true);
                }
            } catch (\Exception $exception) {
                abort(500, $exception->getMessage());
            }
        }

        return $photos;
    }
}
