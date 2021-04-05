<?php 

namespace App\ViewModels\Post;

use App\ViewModels\BaseViewModel;

class IndexViewModel extends BaseViewModel
{
    public array $posts;
    public string $orderBy;
}