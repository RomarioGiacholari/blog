<?php

namespace App\Services\Payment;

interface IPaymentService
{
    public function startSession(int $amount) : ?object;
    public function retrieveSession(string $sessionId) : ?object;
}