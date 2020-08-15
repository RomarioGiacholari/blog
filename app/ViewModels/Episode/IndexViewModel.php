<?php 

namespace App\ViewModels\Episode;

use App\ViewModels\BaseViewModel;
use Illuminate\Contracts\Pagination\Paginator;

class IndexViewModel extends BaseViewModel
{
    public ?Paginator $episodes;
}