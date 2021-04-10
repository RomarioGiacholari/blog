<?php 

namespace App\ViewModels\Post;

use App\ViewModels\BaseViewModel;
use App\ViewModels\Pagination\PaginationViewModel;

class IndexViewModel extends BaseViewModel
{
    public array $posts;
    public string $orderBy;
    public ?PaginationViewModel $pagination = null;
}