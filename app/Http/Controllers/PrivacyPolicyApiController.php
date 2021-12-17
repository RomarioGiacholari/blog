<?php

namespace App\Http\Controllers;

use App\Managers\Privacy\IPrivacyManager;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Cache;

class PrivacyPolicyApiController
{
    private IPrivacyManager $privacyManager;

    public function __construct(IPrivacyManager $privacyManager)
    {
        $this->privacyManager = $privacyManager ?? throw new InvalidArgumentException(IPrivacyManager::class);
    }

    public function index()
    {
        $privacy = Cache::remember('privacy', $seconds = 60 * 60 * 24, fn () => $this->privacyManager->get());
        $status = 200;
        $headers = ['Content-Type' => 'application/json'];

        return response($privacy, $status, $headers);
    }
}
