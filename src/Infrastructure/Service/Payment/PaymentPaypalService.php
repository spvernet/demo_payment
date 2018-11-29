<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 20:13
 */

namespace App\Infrastructure\Service\Payment;


use Psr\Http\Message\RequestInterface;

class PaymentPaypalService extends Chainable
{

    public function __construct(?Chainable $successor)
    {
        parent::__construct($successor);
    }

    protected function processing(/*RequestInterface $request*/)
    {
        // TODO: Implement processing() method.
        return ['array_paypal'];
    }
}