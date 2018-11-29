<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 20:09
 */

namespace App\Infrastructure\Service\Payment;

use App\Infrastructure\Exception\PaymentRequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


abstract class Chainable
{
    private $successor = null;

    public function __construct(?Chainable $successor)
    {
        $this->successor = $successor;
    }

    final public function handle(array $request)
    {
        $processed = $this->processing($request);
        if ($processed === null) {
            if ($this->successor === null){
                throw new PaymentRequestException("Incorrect request format");
            }
            $processed = $this->successor->handle($request);
        }
        return $processed;
    }
    abstract protected function processing(array $request);

}