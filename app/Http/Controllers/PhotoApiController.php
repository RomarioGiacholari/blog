<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PhotoApiController extends Controller
{
    public function index()
    {
        $photos = [];
        $files = (array) Storage::disk('public')->files();

        if ($files != null && count($files) > 0) {
            $photosList = array_filter($files, fn ($file) => strpos($file, 'jpg'));
            
            if ($photosList != null && count($photosList) > 0) {
                $photos = $photosList;
            }
        }

        return response($photos, 200);
    }
}
