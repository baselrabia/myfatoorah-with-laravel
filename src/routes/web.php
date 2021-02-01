<?php




Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/payment/index', 'MyFatoorahController@index')->name('MyFatoorah.index');
    Route::get('/payment/success_callback', 'MyFatoorahController@successCallback')->name('MyFatoorah.success');
    Route::get('/payment/fail_callback', 'MyFatoorahController@failCallback')->name('MyFatoorah.fail');
});
