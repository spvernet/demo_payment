<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 29/11/2018
 * Time: 19:37
 */

namespace App\Tests\Test\Unit\Domain\Usecase\PaymentCreated;


use App\Domain\Core\AbstractOutput;
use App\Domain\Usecase\PaymentCreated\PaymentCreatedUsecase;
use App\Domain\Usecase\PaymentCreated\PaymentPaypalRequest;
use App\Domain\Usecase\PaymentCreated\PaymentRedsysRequest;
use App\Infrastructure\Gateway\inPaypal\PaymentGateway as PaymentPaypalGateway;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Tests\Logger;

class PaymentCreatedTest extends TestCase
{
    public function testRedsysIsValidOK(){
        $request = new PaymentRedsysRequest('100','test test','1111222233334444','11/22','123');
        $this->assertEquals(true, $request->isValid());

    }

    public function testRedsysIsValidKO(){
        $request = new PaymentRedsysRequest('100','');
        $this->assertEquals(false, $request->isValid());
    }

    public function testPaypalIsValidOK(){
        $request = new PaymentPaypalRequest('100','bbb@gmail.com', '123123');
        $this->assertEquals(true, $request->isValid());

    }

    public function testPaypalIsValidKO(){
        $request = new PaymentPaypalRequest('a','');
        $this->assertEquals(false, $request->isValid());
    }

    public function testPaypalReturnError()
    {
        $gateway = $this->getMockBuilder(PaymentPaypalGateway::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();

        $eventDispatcher = $this->getMockBuilder(EventDispatcher::class)
            ->disableOriginalConstructor()
            ->getMock();

        $gateway
            ->expects($this->once())
            ->method('send')
            ->willReturn(null)
        ;

        $request = new PaymentPaypalRequest('100','aaa@gmail.com', '123123');
        $usecase = new PaymentCreatedUsecase(
            $request,
            $gateway,
            $eventDispatcher,
            new Logger()
        );

        /** @var JsonResponse $result */
        $result = $usecase->execute();
        $this->assertEquals('"Error processing the payment"',$result->getContent());
        $this->assertEquals(AbstractOutput::CODE_UNPROCESSABLE, $result->getStatusCode());
    }
}
