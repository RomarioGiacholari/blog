<?php

namespace App\Http\Controllers;

use \stdClass;
use App\Services\Photos\IPhotoService;
use Illuminate\Support\Facades\Cache;

class PhotoController extends Controller
{
    private array $photos;

    public function __construct(IPhotoService $service)
    {
        $this->photos = Cache::remember('photos', $minutes = 60 * 24, fn () => $service->all());
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

        if ($identifier != null && $this->photos != null && count($this->photos) > 0) {
            $filePath = $this->photos[$identifier];
            $friendlyFileName = $identifier;

            $viewModel->photo = $filePath;
            $viewModel->photoFriendlyName = $friendlyFileName;
            $viewModel->pageTitle = "Photos | {$friendlyFileName}";
        }

        return view('photos.show', ['viewModel' => $viewModel]);
    }

    public function photos()
    {
        $viewModel = new stdClass;
        $viewModel->photos = null;

        if ($this->photos != null && count($this->photos) > 0) {
            $viewModel->photos = $this->photos;
        }

        return view('photos.partial', ['viewModel' => $viewModel]);
    }
}
