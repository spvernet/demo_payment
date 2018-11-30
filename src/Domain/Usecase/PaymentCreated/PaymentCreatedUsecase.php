<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:50
 */

namespace App\Domain\Usecase\PaymentCreated;


use App\Domain\Core\AbstractOutput;
use App\Domain\Core\AbstractUsecase;
use App\Domain\Core\PaymentRequest;
use App\Domain\Event\PaymentDoneEvent;
use App\Domain\Manager\PaymentGatewayInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentCreatedUsecase extends AbstractUsecase
{
    /** @var PaymentRequest  */
    protected $paymentRequest;

    /** @var PaymentGatewayInterface */
    protected $gateway;

    /** @var EventDispatcherInterface */
    protected $eventDispacher;

    /** @var LoggerInterface  */
    protected $logger;

    public function __construct(PaymentRequest $paymentRequest,
                                PaymentGatewayInterface $gateway,
                                EventDispatcherInterface $eventDispatcher,
                                LoggerInterface $logger)
    {
        $this->paymentRequest = $paymentRequest;
        $this->gateway = $gateway;
        $this->eventDispacher = $eventDispatcher;
        $this->logger =$logger;
    }

    public function execute()
    {
        if (!$this->paymentRequest->isValid()) {
            $this->logger->error('field or value field not allowed', ['payment.validation']);
            return new JsonResponse('field or value field not allowed', AbstractOutput::CODE_BAD_REQUEST);
        }

        $payment = $this->gateway->send($this->paymentRequest);

        if ($payment == null ) {
            $this->logger->error('Error processing the payment',['payment.validation']);
            return new JsonResponse('Error processing the payment', AbstractOutput::CODE_UNPROCESSABLE);
        }

        $event = new PaymentDoneEvent($payment);
        $this->eventDispacher->dispatch( PaymentDoneEvent::NAME, $event);

        return new JsonResponse(null,AbstractOutput::CODE_CREATED);
    }
}