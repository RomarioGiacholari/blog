<?php 

namespace App\ViewModels;

use App\ViewModels\Pagination\PaginationViewModel;

abstract class BaseViewModel
{
    public ?string $pageTitle;
    public ?PaginationViewModel $pagination = null;
}