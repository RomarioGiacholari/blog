<?php 

namespace App\ViewModels\Episode;

use App\Episode;
use App\ViewModels\BaseViewModel;

class EditViewModel extends BaseViewModel
{
    public ?Episode $post;
}