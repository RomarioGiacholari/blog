<?php

namespace App\Http\Controllers;

use \stdClass;
use Illuminate\Support\Facades\Cache;

class PhotoController extends Controller
{
    private string $files;

    public function __construct()
    {
        $this->files = Cache::remember('files', $minutes = 60 * 24, function () {
            return file_get_contents('https://assets.giacholari.com/json/images-meta-data.json');
        });
    }

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

        if ($identifier != null && $this->files != null) {
            $photoList = json_decode($this->files, true);

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

        if ($this->files != null) {
            $photos = json_decode($this->files, true);
            
            if ($photos != null && count($photos) > 0) {
                $viewModel->photos = $photos;
            }
        }

        return view('photos.partial', ['viewModel' => $viewModel]);
    }
}
