<?php

namespace App\Http\Controllers;

class PhotoApiController extends Controller
{
    public function index()
    {
        $photos = [];
        $files = file_get_contents('https://assets.giacholari.com/json/images-meta-data.json');

        if ($files != null) {
            $photos = json_decode($files, true);
        }

        return response($photos, 200);
    }
}
