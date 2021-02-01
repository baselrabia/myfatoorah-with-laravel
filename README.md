 
 ## Installation
Begin by installing this package through Composer. Just run following command to terminal-

```php
composer require baselrabia/myfatoorah-with-laravel
```

Once this operation completes the package will automatically be discovered for **Laravel 5.6 and above**,

- Run this line to publish package files in your app

```php
 php artisan vendor:publish --provider="Basel\MyFatoorah\MyFatoorahServiceProvider"
```
- after that fire the migration command

```php
php artisan migrate
```
 - last step  in your `.env` file, Add   // you don't have to do this step if you are testing the package

```php
MYFATOORAHTOKEN=************** 
```
 
Otherwise, the final step is to add the service provider. Open `config/app.php`, and add a new item to the providers array.
```php
'providers' => [
	...
	Basel\MyFatoorah\MyFatoorahServiceProvider::class,
],
```
## test card:

### Checkout Process Demo

Please use these ‘test card’ details for your demo

```php

"card": {
	"Number":"5123450000000008",
       	"expiryMonth":"05",
       	"expiryYear":"21",
       	"securityCode":"100"
	},
```


