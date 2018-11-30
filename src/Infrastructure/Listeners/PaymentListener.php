<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 30/11/2018
 * Time: 01:16
 */

namespace App\Infrastructure\Listeners;


use App\Domain\Event\PaymentDoneEvent;

class PaymentListener
{
    public function onPaymentDone(PaymentDoneEvent $event){
        //Send the event to Kafka
    }
}