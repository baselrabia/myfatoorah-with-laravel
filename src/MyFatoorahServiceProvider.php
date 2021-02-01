<?php

namespace Basel\MyFatoorah;

use Illuminate\Support\ServiceProvider;

class MyFatoorahServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->mergeConfigFrom(__DIR__ . '/config/myfatoorah.php','myfatoorah');
       
        $this->publishes([
        __DIR__ . '/config/myfatoorah.php' => config_path('myfatoorah.php'),
        __DIR__ . '/Models/PaymentInvoice.php' => app_path('Models/PaymentInvoice.php'),
        __DIR__ . '/Http/Controllers/MyFatoorahController.php' => app_path('Http/Controllers/MyFatoorahController.php')
        ]);
    }

    /**
    * Register the application services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->singleton('MyFatoorah', function() {
            return MyFatoorah::getInstance();
        });
    }
    
}