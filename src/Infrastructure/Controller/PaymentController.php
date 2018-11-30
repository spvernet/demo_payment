<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:18
 */

namespace App\Infrastructure\Controller;

use App\Domain\Core\AbstractOutput;
use App\Domain\Core\PaymentRequest;
use App\Domain\Event\PaymentDoneEvent;
use App\Domain\Usecase\PaymentCreated\PaymentCreatedUsecase;
use App\Infrastructure\Exception\PaymentRequestException;
use App\Infrastructure\Listeners\PaymentListener;
use App\Infrastructure\Service\Payment\PaymentRedsysService;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaymentController
{

    public function create(Request $request, PaymentRedsysService $paymentService,
                            LoggerInterface $logger)
    {
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener(PaymentDoneEvent::NAME, array(new PaymentListener(), 'onPaymentDone'));

        try {
            $message = json_decode($request->getContent(), true);
            /** @var PaymentRequest $command */
            $command = $paymentService->handle($message);

            $usecase = new PaymentCreatedUsecase($command,
                $command->getGateway(),
                $dispatcher,
                $logger);

        }catch (PaymentRequestException $exception){
            return new JsonResponse($exception->getMessage(), AbstractOutput::CODE_BAD_REQUEST);
        }

        return $usecase->execute();
    }

}