<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class PhotoApiController extends Controller
{
    public function index()
    {
        $photos = [];
        $files = Cache::remember('files', $minutes = 60 * 24, function () {
            return file_get_contents('https://assets.giacholari.com/json/images-meta-data.json');

        });

        if ($files != null) {
            $photos = json_decode($files, true);
        }

        return response($photos, 200);
    }
}
