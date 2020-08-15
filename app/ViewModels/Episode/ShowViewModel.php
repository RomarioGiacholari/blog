<?php 

namespace App\ViewModels\Episode;

use App\Episode;
use App\ViewModels\BaseViewModel;

class ShowViewModel extends BaseViewModel
{
    public ?Episode $episode;
}