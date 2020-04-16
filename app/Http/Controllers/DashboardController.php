<?php

namespace App\Http\Controllers;

use \stdClass;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Dashboard';
        $viewModel->resources = [
            'Posts' => route('home.posts'),
            'Episodes' => route('home.episodes'),
        ];

        return view('dashboard.index', ['viewModel' => $viewModel]);
    }
}
