<?php

namespace App\Http\Controllers;

use stdClass;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Photos';
        $viewModel->photos = null;
        $files = Storage::disk('public')->files();

        if ($files !== null && is_array($files) && count($files) > 0)
        {
            $photos = array_filter($files, function ($file) {
                return strpos($file, 'jpg');
            });
            
            if ($photos !== null && count($photos) > 0)
            {
                $viewModel->photos = $photos;
            }
        }

        return view('photos.index', ['viewModel' => $viewModel]);
    }
}
