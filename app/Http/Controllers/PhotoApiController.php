<?php

namespace App\Http\Controllers;

use App\Services\Photos\IPhotoService;
use Illuminate\Support\Facades\Cache;

class PhotoApiController extends Controller
{
    private IPhotoService $photoService;

    public function __construct(IPhotoService $service)
    {
        $this->photoService = $service;
    }

    public function index()
    {
        $photos = Cache::remember('photos', $seconds = 60 * 60 * 24, fn () => $this->photoService->all());

        return response($photos, 200);
    }
}
