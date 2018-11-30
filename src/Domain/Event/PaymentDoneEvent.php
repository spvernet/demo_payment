<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 30/11/2018
 * Time: 01:06
 */

namespace App\Domain\Event;


use Symfony\Component\EventDispatcher\Event;

class PaymentDoneEvent extends Event
{
    const NAME = 'payment.done';

    protected $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function getOrder()
    {
        return $this->payment;
    }
}