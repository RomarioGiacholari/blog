<?php

namespace App\Http\Controllers;

use App\Managers\Photos\IPhotoManager;
use Illuminate\Support\Facades\Cache;

class PhotoApiController extends Controller
{
    private IPhotoManager $photoManager;

    public function __construct(IPhotoManager $photoManager)
    {
        $this->photoManager = $photoManager;
    }

    public function index()
    {
        $photos = Cache::remember('photos', $seconds = 60 * 60 * 24, fn () => $this->photoManager->all());
        $status = 200;
        $headers = ['Content-Type' => 'application/json'];

        return response($photos, $status, $headers);
    }
}
