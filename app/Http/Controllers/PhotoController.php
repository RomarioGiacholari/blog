<?php

namespace App\Http\Controllers;

use Storage;
use App\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Storage::disk('public')->files();
        
        $photos = array_filter($files, function ($file) {
            return strpos($file, 'jpg');
        });
        
        return view('photos.index', compact('photos'));
    }
}
