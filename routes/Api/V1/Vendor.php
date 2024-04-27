<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\V1\Create\CreateNewProductController;
use App\Http\Controllers\Api\Store\V1\Activation\AccountActivationController;
use App\Http\Controllers\Api\Product\V1\Fetch\VendorDashboardProductsController;

Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::group(['prefix' => 'authentication'], function () {
            Route::post('/activation', [AccountActivationController::class, 'handle']);
        });

        Route::group(['prefix' => 'product-management'], function () {
            Route::post('/create', [CreateNewProductController::class, 'handle']);
            Route::get('/getAllVendorProducts', [VendorDashboardProductsController::class, 'handle']);
    
    });
});