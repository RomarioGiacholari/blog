<?php 

namespace App\ViewModels\Privacy;

use App\ViewModels\BaseViewModel;

class ContentViewModel extends BaseViewModel
{
    public string $introduction;
    public array $content;
    public string $contactEmail;
}