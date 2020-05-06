<?php

namespace App\Http\Controllers;

use \stdClass;

class PhotoController extends Controller
{
    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Photos';

        return view('photos.index', ['viewModel' => $viewModel]);
    }

    public function show(string $identifier)
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = null;
        $viewModel->photo = null;
        $viewModel->photoFriendlyName = null;
        $files = file_get_contents('https://romariogiacholari.github.io/static/json/images-meta-data.json');

        if ($identifier != null && $files != null) {
            $photoList = json_decode($files, true);

            if ($photoList != null && count($photoList) > 0) {
                $filePath = $photoList[$identifier];
                $friendlyFileName = $identifier;

                $viewModel->photo = $filePath;
                $viewModel->photoFriendlyName = $friendlyFileName;
                $viewModel->pageTitle = "Photos | {$friendlyFileName}";
            }
        }

        return view('photos.show', ['viewModel' => $viewModel]);
    }

    public function photos()
    {
        $viewModel = new stdClass;
        $viewModel->photos = null;
        $files = file_get_contents('https://romariogiacholari.github.io/static/json/images-meta-data.json');

        if ($files != null) {
            $photos = json_decode($files, true);
            
            if ($photos != null && count($photos) > 0) {
                $viewModel->photos = $photos;
            }
        }

        return view('photos.partial', ['viewModel' => $viewModel]);
    }
}
