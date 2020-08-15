<?php 

namespace App\ViewModels\Home;

use App\ViewModels\BaseViewModel;
use Illuminate\Database\Eloquent\Collection;

class EpisodesViewModel extends BaseViewModel
{
   public ?Collection $episodes;
}