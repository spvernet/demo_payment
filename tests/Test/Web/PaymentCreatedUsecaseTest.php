<?php
namespace App\Tests\Test\Web;


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
    }

    public function testRedsysOK(){

    }


    public function testPaypalKO(){

    }

    public function testRedsysKO(){

    }

}