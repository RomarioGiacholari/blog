<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Services\Photos\IPhotoService;
use App\ViewModels\Photo\IndexViewModel;
use App\ViewModels\Photo\ShowViewModel;
use App\ViewModels\Photo\PhotoListViewModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhotoController extends Controller
{
    private array $photos;

    public function __construct(IPhotoService $service)
    {
        $this->photos = Cache::remember('photos', $minutes = 60 * 24, fn () => $service->all());
    }

    public function index()
    {
        $viewModel = new IndexViewModel;
        $viewModel->pageTitle = 'Photos';

        return view('photos.index', ['viewModel' => $viewModel]);
    }

    public function show(string $identifier)
    {
        if (!array_key_exists($identifier, $this->photos)) {
            throw new NotFoundHttpException();
        }

        $viewModel = new ShowViewModel;
        $viewModel->pageTitle = null;
        $viewModel->photo = null;
        $viewModel->photoFriendlyName = null;

        if (isset($identifier) && isset($this->photos) && count($this->photos) > 0) {
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
        $viewModel = new PhotoListViewModel;
        $viewModel->photos = null;

        if (isset($this->photos) && count($this->photos) > 0) {
            $viewModel->photos = $this->photos;
        }

        return view('photos.partial', ['viewModel' => $viewModel]);
    }
}
