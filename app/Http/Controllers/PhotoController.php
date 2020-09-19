<?php

namespace App\Http\Controllers;

use App\Services\Photos\IPhotoService;
use App\ViewModels\Photo\IndexViewModel;
use App\ViewModels\Photo\PhotoListViewModel;
use App\ViewModels\Photo\ShowViewModel;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhotoController extends Controller
{
    private ?array $photos;

    public function __construct(IPhotoService $service)
    {
        $this->photos = Cache::rememberForever('photos', fn () => $service->all());
    }

    public function index()
    {
        $viewModel            = new IndexViewModel();
        $viewModel->pageTitle = 'Photos';

        return view('photos.index', ['viewModel' => $viewModel]);
    }

    public function show(string $identifier)
    {
        $viewModel                    = new ShowViewModel();
        $viewModel->pageTitle         = "Photos | {$identifier}";
        $viewModel->photo             = null;
        $viewModel->photoFriendlyName = $identifier;

        if (isset($this->photos) && \count($this->photos) > 0) {
            if (!\array_key_exists($identifier, $this->photos)) {
                throw new NotFoundHttpException();
            }

            $filePath         = $this->photos[$identifier];
            $viewModel->photo = $filePath;
        }

        return view('photos.show', ['viewModel' => $viewModel]);
    }

    public function photos()
    {
        $viewModel         = new PhotoListViewModel();
        $viewModel->photos = null;

        if (isset($this->photos) && \count($this->photos) > 0) {
            $viewModel->photos = $this->photos;
        }

        return view('photos.partial', ['viewModel' => $viewModel]);
    }
}
