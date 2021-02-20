<?php 

namespace App\ViewModels\Post;

use App\ViewModels\BaseViewModel;
use Illuminate\Contracts\Pagination\Paginator;

class IndexViewModel extends BaseViewModel
{
    public ?Paginator $posts;
    public string $orderBy;
}