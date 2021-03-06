<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:20
 */

namespace App\Infrastructure\Gateway\inPaypal;


use App\Domain\Core\AbstractGateway;
use App\Domain\Core\PaymentRequest;

class PaymentGateway extends AbstractGateway
{

    public function send(PaymentRequest $paymentRequest)
    {
        // This function, would send the information on paypal api.
        // If everything is correct, would receive "done paypal" (in a real case, we'd receive other kind of information)
        // Otherwise would receive null;
        return "done Paypal";
    }
}