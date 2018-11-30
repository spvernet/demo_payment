<?php
namespace App\Tests\Test\Web;


use App\Domain\Core\AbstractOutput;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaymentCreatedUsecaseTest extends WebTestCase
{

    public function testPaypalOK(){
        $data = array(
            'amount' => '100',
            'email' =>'test@test.com',
            'password' => '123456789'
        );

        $client = $this->createClient();

        $client->request(
            'POST',
            '/payment',
            array(
                'Content-type' => 'application/json; charset=utf-8',
            ),
            array(),
            array(),
            json_encode($data)
        );

        $result= json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(AbstractOutput::CODE_CREATED, $client->getResponse()->getStatusCode());
        $this->assertEquals([], $result);
    }

    public function testRedsysOK(){
        $data = array(
            'amount' => '100',
            'full_name' =>'Jose Garcia Garcia',
            'card_number' => '1111222233334444',
            'expiration' => '11/20',
            'cvv'=>'123'
        );

        $client = $this->createClient();

        $client->request(
            'POST',
            '/payment',
            array(
                'Content-type' => 'application/json; charset=utf-8',
            ),
            array(),
            array(),
            json_encode($data)
        );

        $result= json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(AbstractOutput::CODE_CREATED, $client->getResponse()->getStatusCode());
        $this->assertEquals([], $result);
    }


    public function testPaymentKO(){
        $data = array(
            'amount' => null,
            'email' =>'test@test.com',
            'password' => '123456789'
        );

        $client = $this->createClient();

        $client->request(
            'POST',
            '/payment',
            array(
                'Content-type' => 'application/json; charset=utf-8',
            ),
            array(),
            array(),
            json_encode($data)
        );

        $result= json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(AbstractOutput::CODE_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this->assertEquals('field or value field not allowed', $result);
    }

    public function testWrongRequestKO(){
        $data = array(
            'username' => 'test',
            'password' => '123456789'
        );

        $client = $this->createClient();

        $client->request(
            'POST',
            '/payment',
            array(
                'Content-type' => 'application/json; charset=utf-8',
            ),
            array(),
            array(),
            json_encode($data)
        );

        $result= json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(AbstractOutput::CODE_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this->assertEquals('Incorrect request format', $result);
    }

}