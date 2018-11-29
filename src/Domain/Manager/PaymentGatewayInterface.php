<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:55
 */

namespace App\Domain\Manager;


use App\Domain\Core\PaymentRequest;

interface PaymentGatewayInterface
{
    public function send(PaymentRequest $paymentRequest);
}