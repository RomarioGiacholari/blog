<?php 

namespace App\ViewModels\Post;

use App\ViewModels\BaseViewModel;
use Illuminate\Contracts\Pagination\Paginator;

class IndexViewModel extends BaseViewModel
{
    public array $posts;
    public string $orderBy;
}