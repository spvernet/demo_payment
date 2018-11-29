<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 20:13
 */

namespace App\Infrastructure\Service\Payment;


use App\Domain\Usecase\PaymentCreated\PaymentPaypalRequest;
use Psr\Http\Message\RequestInterface;

class PaymentPaypalService extends Chainable
{

    public function __construct(?Chainable $successor)
    {
        parent::__construct($successor);
    }

    protected function processing(array $request)
    {
        if(!isset($request['email'])) {
           return null;
        }

        $command = new PaymentPaypalRequest($request['amount'],
            $request['email'], $request['password']);

        return $command;
    }
}