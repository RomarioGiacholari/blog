<?php 

namespace App\ViewModels\Photo;

use App\ViewModels\BaseViewModel;

class ShowViewModel extends BaseViewModel
{
   public ?string $photo;
   public ?string $photoFriendlyName;
}