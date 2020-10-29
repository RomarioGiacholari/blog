<?php

namespace App\Http\Controllers;

use App\Services\Privacy\IPrivacyService;
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

    public function content(IPrivacyService $privacyService)
    {
        $websiteName     = 'giacholari.com';
        $contactEmail    = config('app.admin_email') ?? 'giacholari@gmail.com';
        $privacyContent  = Cache::remember('privacyContent', $seconds = 60 * 60 * 24, function () use ($privacyService) {
            $content  = $privacyService->get();

            return $content;
        });

        $viewModel               = new ContentViewModel();
        $viewModel->introduction = "This privacy policy applies to the website {$websiteName}";
        $viewModel->content      = $privacyContent;
        $viewModel->contactEmail = $contactEmail;

        return view('privacy-policy.content', ['viewModel' => $viewModel]);
    }
}
