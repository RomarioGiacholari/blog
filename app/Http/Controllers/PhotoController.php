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

        if ($files != null && is_array($files) && count($files) > 0) {
            $photos = array_filter($files, function ($file) {
                return strpos($file, 'jpg');
            });

            if ($photos != null && count($photos) > 0) {
                $viewModel->photos = $photos;
            }
        }

        return view('photos.index', ['viewModel' => $viewModel]);
    }

    public function show(string $identifier)
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Show";
        $viewModel->photo = null;
        $files = Storage::disk('public')->files();

        if (is_string($identifier) && $identifier != null) {
            if ($files != null && is_array($files) && count($files) > 0) {
                $photoList = array_filter($files, function ($fileName) use ($identifier) {
                    return $fileName == $identifier;
                });

                if ($photoList != null && count($photoList) > 0) {
                    $arrayKeys = array_keys($photoList);
                    $index = $arrayKeys[0];
                    $fileName = $photoList[$index];
                    $viewModel->photo = $fileName;
                }
            }
        }

        return view('photos.show', ['viewModel' => $viewModel]);
    }
}
