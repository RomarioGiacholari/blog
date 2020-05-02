<?php

namespace App\Http\Controllers;

use stdClass;

class AboutController extends Controller
{
    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'About me';

        return view('about.index', ['viewModel' => $viewModel]);
    }
}
