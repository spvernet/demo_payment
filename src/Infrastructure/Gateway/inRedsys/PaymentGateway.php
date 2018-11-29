<?php

namespace App\Infrastructure\Gateway\inRedsys;


use App\Domain\Core\AbstractGateway;
use App\Domain\Core\PaymentRequest;

class PaymentGateway extends AbstractGateway
{

    public function send(PaymentRequest $paymentRequest)
    {
        // This function, would send the information on redsys api.
        // If everything is correct, would receive a payment ID.
        // Otherwise would receive null;
        return "20008";

    }
}