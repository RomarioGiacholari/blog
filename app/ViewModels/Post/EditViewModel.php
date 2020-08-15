<?php 

namespace App\ViewModels\Post;

use App\Post;
use App\ViewModels\BaseViewModel;

class EditViewModel extends BaseViewModel
{
    public ?Post $post;
}