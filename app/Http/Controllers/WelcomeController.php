<?php

namespace App\Http\Controllers;

use \stdClass;

class WelcomeController extends Controller
{
    public function index()
    {
        $viewModel = new stdClass;
        $viewModel->pageTitle = 'Welcome';
    
        return view('welcome', ['viewModel' => $viewModel]);
    }
}
