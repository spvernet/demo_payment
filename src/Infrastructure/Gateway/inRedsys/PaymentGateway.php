<?php

namespace App\Infrastructure\Gateway\inRedsys;


use App\Domain\Core\AbstractGateway;
use App\Domain\Core\PaymentRequest;

class PaymentGateway extends AbstractGateway
{

    public function send(PaymentRequest $paymentRequest)
    {
        // This function, would send the information on redsys api.
        // If everything is correct, "done redsys" (in a real case, we'd receive other kind of information)
        // Otherwise would receive null;
        return "done redsys";

    }
}