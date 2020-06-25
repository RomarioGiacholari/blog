<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Services\Photos\IPhotoService;

class PhotoApiController extends Controller
{
    private IPhotoService $photoService;

    public function __construct(IPhotoService $service)
    {
        $this->photoService = $service ?? null;
    }

    public function index()
    {
        $photos = Cache::remember('photos', $minutes = 60 * 24, fn () => $this->photoService->all());

        return response($photos, 200);
    }
}
