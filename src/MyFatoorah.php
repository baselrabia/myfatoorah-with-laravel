<?php

namespace Basel\MyFatoorah;

use Basel\MyFatoorah\Http\MFConnect;
 

class MyFatoorah extends MFConnect
{
    private static $instance = null;

    private function __construct($isTest = false)
    {
        parent::__construct($isTest);
    }

    
    public static function getInstance($isTest = false)
    {
        if (self::$instance == null) {
            self::$instance = new MyFatoorah($isTest);
        }
        return self::$instance;
    }
    /**
     * @param $customerName
     * @param $invoiceValue
     * @param $params
     * @return mixed|string
     */
    public function sendPayment($customerName, $invoiceValue, $params)
    {

        $notificationOption = 'LNK';
        if (array_key_exists('NotificationOption', $params)) {
            $notificationOption = $params['NotificationOption'];
        }

        $parameters = [
            'NotificationOption' => $notificationOption,
            'CustomerName' => $customerName,
            'InvoiceValue' => $invoiceValue,
            'DisplayCurrencyIso' => config('myfatoorah.DisplayCurrencyIso'),
            'CallBackUrl' => config('myfatoorah.CallBackUrl'),
            'ErrorUrl' => config('myfatoorah.ErrorUrl'),
        ];

        $myfa_params = [
            'MobileCountryCode', 'CustomerMobile', 'CustomerEmail','Language', 'CustomerReference',
            'CustomerCivilId', 'UserDefinedField', 'ExpireDate', 'CustomerAddress', 'InvoiceItems'
        ];


        foreach ($myfa_params as $myfa_param) {
            if (array_key_exists($myfa_param, $params)) {
                $parameters[$myfa_param] = $params[$myfa_param];
            }
        }

        $url = $this->getUrl('SendPayment');

        return $this->postJson($url, $parameters, $this->header);
    }

    /**
     * @param $key
     * @param $keyType
     * @return mixed|string
     */
    public function getPaymentStatus($keyType, $key)
    {

        $parameters = [
            'Key' => $key,
            'KeyType' => $keyType,
        ];

        $url = $this->getUrl('GetPaymentStatus');
        return $this->postJson($url, $parameters, $this->header);
    }



}