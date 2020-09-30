<?php

namespace App\Http\Controllers;

use App\ViewModels\Privacy\ContentViewModel;
use App\ViewModels\Privacy\IndexViewModel;
use Illuminate\Support\Facades\Cache;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $viewModel            = new IndexViewModel();
        $viewModel->pageTitle = 'Privacy policy';

        return view('privacy-policy.index', ['viewModel' => $viewModel]);
    }

    public function content()
    {
        $appName      = config('app.name') ?? 'giacholari.com';
        $contactEmail = config('app.admin_email') ?? 'giacholari@gmail.com';
        $privacyJson  = Cache::rememberForever('privacyFile', function () {
            return file_get_contents('https://assets.giacholari.com/json/privacy.json');
        });

        $viewModel               = new ContentViewModel();
        $viewModel->introduction = "This privacy policy applies to the website {$appName}";
        $viewModel->content      = json_decode($privacyJson, true);
        $viewModel->contactEmail = $contactEmail;

        return view('privacy-policy.content', ['viewModel' => $viewModel]);
    }
}
