<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Order\V1\Fetch\FetchStoreOrderController;
use App\Http\Controllers\Api\Store\V1\Fetch\VendorProfileController;
use App\Http\Controllers\Api\Product\V1\Create\CreateNewProductController;
use App\Http\Controllers\Api\Store\V1\Activation\AccountActivationController;

Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::group(['prefix' => 'authentication'], function () {
            Route::post('/activation', [AccountActivationController::class, 'handle']);
        });

        Route::group(['prefix' => 'product-management'], function () {
            Route::post('/create', [CreateNewProductController::class, 'handle']);
    });
    Route::prefix('store')->group(function () {
        Route::get('/orders', [FetchStoreOrderController::class, 'handle']);
        Route::get('/profile', [VendorProfileController::class, 'handle']);
    });
});

