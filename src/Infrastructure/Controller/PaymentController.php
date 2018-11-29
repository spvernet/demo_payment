<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:18
 */

namespace App\Infrastructure\Controller;


use App\Infrastructure\Service\Payment\PaymentRedsysService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaymentController
{

    public function create(Request $request, PaymentRedsysService $paymentService)
    {
        $a = $paymentService->handle();
        $messageArray = json_decode($request->getContent(), true);

        return new JsonResponse($a);
    }

}