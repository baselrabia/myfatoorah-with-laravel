<?php

namespace Basel\MyFatoorah\Tests\Unit\PaymentOperations;

use Basel\MyFatoorah\MyFatoorah;
use PHPUnit\Framework\TestCase;

class SendPaymentTest extends TestCase
{
    

    /**
     * Generate payment url to pay through MyFatoorah pages
     */
    public function testGeneratePaymentUrl() {
        $initPayment = MyFatoorah::getInstance(true);

        $result = $initPayment->sendPayment(
            'Customer Name',
            300,
            [
                //     'MobileCountryCode',
                'CustomerMobile' => "56562123544",
                //     'CustomerEmail',
                //     'Language' =>"AR",
                'CustomerReference' => "1323",  //orderID
                // 'CustomerCivilId' => "321",
                'UserDefinedField' => "3241", //clientID
                //     'ExpireDate',
                //     'CustomerAddress',
                "InvoiceItems" => [
                    [
                        "ItemName" => "Order 123",
                        "Quantity" => 1,
                        "UnitPrice" => 300
                    ]
                ]
            ]
        );

        $this->assertIsArray($result);

        print PHP_EOL.print_r($result, true).PHP_EOL;
    }


    //  "paymentType": "card",
    // "card": {"Number":"5123450000000008",
    //     "expiryMonth":"05",
    //     "expiryYear":"21",
    //     "securityCode":"100"},
    // "saveToken": false}';

    
    public function testPaymentStatus()
    {

        $initPayment =  MyFatoorah::getInstance(true);
        $result = $initPayment->getPaymentStatus('paymentId','060641949131919463');
        $this->assertIsArray($result);

        print PHP_EOL . print_r($result, true) . PHP_EOL;

    }

     

}