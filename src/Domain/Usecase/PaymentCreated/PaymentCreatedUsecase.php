<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:50
 */

namespace App\Domain\Usecase\PaymentCreated;


use App\Domain\Core\AbstractUsecase;
use Psr\Log\LoggerInterface;

class PaymentCreatedUsecase extends AbstractUsecase
{

    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger =$logger;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}