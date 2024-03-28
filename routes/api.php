<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1'], function () {
    Route::prefix('/admin')->group(__DIR__.'/Api/V1/Admin.php');
    Route::prefix('/customer')->group(__DIR__.'/Api/V1/Customer.php');
    Route::prefix('/product')->group(__DIR__.'/Api/V1/Product.php');
    Route::prefix('/user')->group(__DIR__.'/Api/V1/Authentication.php');
    Route::prefix('/vendor')->group(__DIR__.'/Api/V1/Vendor.php');
    Route::prefix('/artisan')->group(__DIR__.'/Api/V1/Artisan.php');


});

Route::get('/payment/callback', function (Request $request){
    dd($request->all());
});


