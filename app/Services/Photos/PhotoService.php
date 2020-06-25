<?php

namespace App\Services\Photos;

class PhotoService implements IPhotoService
{
    public function all() : array
    {
        $photos = [];

        $files = file_get_contents('https://assets.giacholari.com/json/images-meta-data.json');

        if ($files != null) {
            $photos = json_decode($files, true);
        }

        return $photos;
    }
}
