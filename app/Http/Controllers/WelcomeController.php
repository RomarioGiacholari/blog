<?php

namespace App\Http\Controllers;

use App\ViewModels\Welcome\IndexViewModel;

class WelcomeController extends Controller
{
    public function index()
    {
        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'Welcome';

        return view('welcome', ['viewModel' => $viewModel]);
    }
}
