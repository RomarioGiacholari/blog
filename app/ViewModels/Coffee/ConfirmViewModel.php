<?php 

namespace App\ViewModels\Coffee;

use App\ViewModels\BaseViewModel;

class ConfirmViewModel extends BaseViewModel
{
    public ?string $stripePublicKey;
    public ?string $sessionId;
    public ?int $friendlyAmount;
}