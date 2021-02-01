<?php

namespace App\Http\Controllers;

use App\Models\PaymentInvoice;
use Basel\MyFatoorah\MyFatoorah;
use Exception;
use Illuminate\Http\Request;

class MyFatoorahController extends Controller
{
    public $myfatoorah;

    public function __construct()
    {
        $this->myfatoorah = MyFatoorah::getInstance(true);
    }


    public function index()
    {
        try {

            $result = $this->myfatoorah->sendPayment(
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
            if ($result && $result['IsSuccess'] == true) {
                return redirect($result['Data']['InvoiceURL']);
            }

            ///handel else there error
            //  "paymentType": "card",
            // "card": {"Number":"5123450000000008",
            //     "expiryMonth":"05",
            //     "expiryYear":"21",
            //     "securityCode":"100"},
            // "saveToken": false}';
        } catch (Exception $e) {
            echo $e->getMessage();
            echo $e->getResponse()->getBody()->getContents();

            //    dd($e  ,$e->getResponse()->getBody()->getContents() );
        }
    }

    public function successCallback(Request $request)
    {

        //  "paymentId" => "060641960331928262"
        //   "Id" => "060641960331928262"

        if (array_key_exists('paymentId', $request->all())) {
            $result = $this->myfatoorah->getPaymentStatus('paymentId', $request->paymentId);

            if ($result && $result['IsSuccess'] == true && $result['Data']['InvoiceStatus'] == "Paid") {

                // Logic after success
                $this->createInvoice($result['Data']);
                echo "success payment";
            }
        }
    }

    public function failCallback(Request $request)
    {

        if (array_key_exists('paymentId', $request->all())) {
            $result = $this->myfatoorah->getPaymentStatus('paymentId', $request->paymentId);

            if ($result && $result['IsSuccess'] == true && $result['Data']['InvoiceStatus'] == "Pending") {

                // Logic after fail
                $error = end($result['Data']['InvoiceTransactions'])['Error'];
                echo "Error => " . $error;
            }
        }
    }

    public function createInvoice($request)
    {
        $paymentarray = array_merge($request, end($request['InvoiceTransactions']));
        $paymentarray['order_id'] = $paymentarray['CustomerReference'];
        $paymentarray['client_id'] = $paymentarray['UserDefinedField'];

        $PaymentInvoice = PaymentInvoice::create($paymentarray);
    }
}
