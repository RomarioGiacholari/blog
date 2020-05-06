<?php

namespace App\Http\Controllers;

use \stdClass;
use Illuminate\Support\Facades\Storage;

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
        $files = (array) Storage::disk('public')->files();

        if ($identifier != null && $files != null && count($files) > 0) {
            $photoList = array_filter($files, fn ($fileName) => $fileName == $identifier);

            if ($photoList != null && count($photoList) > 0) {
                $arrayKeys = array_keys($photoList);
                $index = $arrayKeys[0];
                $fileName = $photoList[$index];
                $friendlyFileName = str_replace(".jpg", "", $fileName);

                $viewModel->photo = $fileName;
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

        return view('photos._photos-partial', ['viewModel' => $viewModel]);
    }
}
