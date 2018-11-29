<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:18
 */

namespace App\Infrastructure\Controller;


use App\Domain\Core\AbstractGateway;
use App\Domain\Core\AbstractOutput;
use App\Domain\Core\PaymentRequest;
use App\Domain\Usecase\PaymentCreated\PaymentCreatedUsecase;
use App\Infrastructure\Exception\PaymentRequestException;
use App\Infrastructure\Service\Payment\PaymentRedsysService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaymentController
{

    public function create(Request $request, PaymentRedsysService $paymentService,
                            LoggerInterface $logger)
    {
        try {
            $message = json_decode($request->getContent(), true);

            /** @var PaymentRequest $command */
            $command = $paymentService->handle($message);

            $usecase = new PaymentCreatedUsecase($command,
                $command->getGateway(),
                $logger);

        }catch (PaymentRequestException $exception){
            return new JsonResponse($exception->getMessage(), AbstractOutput::CODE_BAD_REQUEST);
        }

        return $usecase->execute();
    }

}