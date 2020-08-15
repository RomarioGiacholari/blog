<?php 

namespace App\ViewModels\Post;

use App\Post;
use App\ViewModels\BaseViewModel;

class ShowViewModel extends BaseViewModel
{
    public ?Post $post;
    public ?string $author;
}