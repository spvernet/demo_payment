<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 23:27
 */

namespace App\Domain\Usecase\PaymentCreated;


use App\Domain\Core\AbstractGateway;
use App\Domain\Core\PaymentRequest;
use App\Infrastructure\Gateway\inRedsys\PaymentGateway;

class PaymentRedsysRequest implements PaymentRequest
{

    /** @var string */
    private $full_name;

    /** @var string */
    private $card_number;

    /** @var string */
    private $expiration;

    /** @var string */
    private $cvv;

    /** @var string */
    private $amount;

    public function __construct(?string $amount = null,
                                ?string $full_name = null,
                                ?string $card_number = null,
                                ?string $expiration = null,
                                ?string $cvv = null)
    {
        $this->amount = $amount;
        $this->full_name = $full_name;
        $this->card_number = $card_number;
        $this->expiration = $expiration;
        $this->cvv = $cvv;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->card_number;
    }

    /**
     * @return string
     */
    public function getExpiration(): string
    {
        return $this->expiration;
    }

    /**
     * @return string
     */
    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function isValid(): bool
    {
        return !($this->full_name ==null ||
            $this->amount ==null ||
            $this->card_number ==null ||
            $this->expiration ==null ||
            $this->cvv ==null );
    }

    public function getGateway(): AbstractGateway {
        return new PaymentGateway();
    }
}