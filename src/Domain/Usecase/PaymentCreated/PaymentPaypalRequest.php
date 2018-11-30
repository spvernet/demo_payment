<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 23:31
 */

namespace App\Domain\Usecase\PaymentCreated;



use App\Domain\Core\AbstractGateway;
use App\Domain\Core\PaymentRequest;
use App\Infrastructure\Gateway\inPaypal\PaymentGateway;

class PaymentPaypalRequest implements PaymentRequest
{
    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /** @var string */
    private $amount;

    public function __construct(?string $amount = null, ?string $email = null, ?string $password = null)
    {
        $this->amount = $amount;
        $this->email = $email;
        $this->password = $password;

    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    public function isValid(): bool
    {
        //WATCH OUT! this is a simple validation, we could validate that email is an email, that the amount is positive, etc.

        return !($this->email == null || $this->password == null || $this->amount == null);
    }

    public function getGateway(): AbstractGateway{
        return new PaymentGateway();
    }
}