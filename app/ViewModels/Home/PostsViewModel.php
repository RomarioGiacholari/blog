<?php 

namespace App\ViewModels\Home;

use App\ViewModels\BaseViewModel;
use Illuminate\Database\Eloquent\Collection;

class PostsViewModel extends BaseViewModel
{
   public ?Collection $posts;
}