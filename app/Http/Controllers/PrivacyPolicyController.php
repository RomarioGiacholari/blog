<?php

namespace App\Http\Controllers;

use \stdClass;
use Illuminate\Support\Facades\Cache;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = "Privacy policy";

        return view('privacy-policy.index', ['viewModel' => $viewModel]);
    }

    public function content()
    {
        $appName = config('app.name') ?? 'giacholari.com';
        $privacyFile = Cache::remember('privacyFile', $minutes = 60 * 24, function () {
            return file_get_contents('https://assets.giacholari.com/json/privacy.json');
        });

        $viewModel = new stdClass;
        $viewModel->introduction = "This privacy policy applies to the website {$appName}";
        $viewModel->content = json_decode($privacyFile, true);
        $viewModel->contactEmail = "giacholari@gmail.com";

        return view('privacy-policy.content', ['viewModel' => $viewModel]);
    }
}
