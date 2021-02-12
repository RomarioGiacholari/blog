<?php

namespace App\Http\Controllers;

use App\ViewModels\About\IndexViewModel;

class AboutController extends Controller
{
    public function index()
    {
        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'About me';

        return view('about.index', ['viewModel' => $viewModel]);
    }
}
