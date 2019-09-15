<?php

namespace App\Http\Controllers;

use Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $files = Storage::disk('public')->files();
        
        $photos = array_filter($files, function ($file) {
            return strpos($file, 'jpg');
        });
        
        return view('photos.index', ['photos' => $photos]);
    }
}
