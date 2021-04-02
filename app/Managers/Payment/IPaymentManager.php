<?php

namespace App\Managers\Payment;

interface IPaymentManager
{
    public function startSession(int $amount) : ?object;
    public function retrieveSession(string $sessionId) : ?object;
}