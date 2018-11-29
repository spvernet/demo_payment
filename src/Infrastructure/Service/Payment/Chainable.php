<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 20:09
 */

namespace App\Infrastructure\Service\Payment;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


abstract class Chainable
{
    /**
     * @var Handler|null
     */
    private $successor = null;

    public function __construct(?Chainable $successor)
    {
        $this->successor = $successor;
    }
    /**
     * This approach by using a template method pattern ensures you that
     * each subclass will not forget to call the successor
     *
     * @param RequestInterface $request
     *
     * @return string|null
     */
    final public function handle(/* RequestInterface $request*/)
    {
        $processed = $this->processing(/*$request*/);
        if ($processed === null) {
            // the request has not been processed by this handler => see the next
            if ($this->successor !== null) {
                $processed = $this->successor->handle(/*$request*/);
            }
        }
        return $processed;
    }
    abstract protected function processing(/*RequestInterface $request*/);

}