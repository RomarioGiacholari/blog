<?php

namespace App\Http\Controllers;

use App\Managers\Photos\IPhotoManager;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

class PhotoApiController extends Controller
{
    private IPhotoManager $photoManager;

    public function __construct(IPhotoManager $photoManager)
    {
        $this->photoManager = $photoManager ?? throw new InvalidArgumentException(IPhotoManager::class);
    }

    public function index()
    {
        $photos = Cache::remember('photos', $seconds = 60 * 60 * 24, fn () => $this->photoManager->all());
        $status = 200;
        $headers = ['Content-Type' => 'application/json'];

        return response($photos, $status, $headers);
    }
}
