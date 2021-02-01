<?php

namespace Basel\MyFatoorah\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Basel\MyFatoorah\MyFatoorahServiceProvider;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            MyFatoorahServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
