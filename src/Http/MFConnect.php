<?php

namespace Basel\MyFatoorah\Http;

use Basel\MyFatoorah\Http\Traits\MFHttpRequest;

class MFConnect
{

    use MFHttpRequest;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var boolean
     */
    protected $isTest;

    /**
     * @var array
     */
    protected $header;

    /**
     * @var string
     */
    protected $host = 'https://api.myfatoorah.com/v2/';

    /**
     * @var string
     */
    protected $hostTest = 'https://apitest.myfatoorah.com/v2/';

    /**
     * MFConnect constructor.
     * @param $token
     * @param bool $isTest
     */
    public function __construct($isTest = false )
    {
        $this->setToken(config('myfatoorah.token'));
        $this->setIsTest($isTest);
        $this->setHeader();
    }

    /**
     * @param $isTest
     */
    protected function setIsTest($isTest)
    {
        $this->isTest = $isTest;
        if ($isTest == true) {
            $this->setToken(config('myfatoorah.test_token'));
        }
    }

    /**
     * @param $token
     * @return $this
     */
    protected function setToken($token)
    {
        $this->token = 'Bearer ' . $token;
        return $this;
    }

    /**
     * @param array $header
     * @return $this
     */
    protected function setHeader(array $header = [])
    {
        $header['Authorization'] = $this->token;
        $this->header = $header;
        return $this;
    }

    /**
     * @param $path
     * @return string
     */
    protected function getUrl($path)
    {
        return ($this->isTest) ? $this->hostTest . $path : $this->host . $path;
    }

}
