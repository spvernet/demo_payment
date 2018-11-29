<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 23:45
 */

namespace App\Domain\Core;


interface PaymentRequest
{
    public function isValid(): bool;
    public function getGateway(): AbstractGateway;
}