<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 20:13
 */

namespace App\Infrastructure\Service\Payment;


use App\Domain\Usecase\PaymentCreated\PaymentRedsysRequest;
use Psr\Http\Message\RequestInterface;

class PaymentRedsysService extends Chainable
{

    public function __construct(?Chainable $successor)
    {
        parent::__construct($successor);
    }


    protected function processing(array $request)
    {
        if(!isset($request['card_number'])){
            return null;
        }

        $command = new PaymentRedsysRequest($request['amount'],
            $request['full_name'], $request['card_number'],
            $request['expiration'], $request['cvv']);

        return $command;
    }
}