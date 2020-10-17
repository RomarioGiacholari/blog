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
        $websiteName     = 'giacholari.com';
        $contactEmail    = config('app.admin_email') ?? 'giacholari@gmail.com';
        $privacyContent  = Cache::remember('privacyContent', $seconds = 60 * 60 * 24, function () {
            $decodedContent  = null;
            $privacyEndpoint = config('services.privacy.endpoint');
            $privacyJson     = file_get_contents($privacyEndpoint);

            if ($privacyJson) {
                $decodedContent = json_decode($privacyJson, true);
            }

            return $decodedContent;
        });

        $viewModel               = new ContentViewModel();
        $viewModel->introduction = "This privacy policy applies to the website {$websiteName}";
        $viewModel->content      = $privacyContent;
        $viewModel->contactEmail = $contactEmail;

        return view('privacy-policy.content', ['viewModel' => $viewModel]);
    }
}
