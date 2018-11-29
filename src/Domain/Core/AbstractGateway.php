<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:58
 */

namespace App\Domain\Core;


use App\Domain\Manager\PaymentGatewayInterface;

abstract class AbstractGateway implements PaymentGatewayInterface
{
}