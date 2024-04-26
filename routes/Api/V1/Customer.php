<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\V1\Fetch\GetHotSalesController;
use App\Http\Controllers\Api\Cart\V1\Fetch\FetchCartRecordController;
use App\Http\Controllers\Api\Product\V1\Fetch\HomeDashboardController;
use App\Http\Controllers\Api\Cart\V1\Create\AddProductToCartController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetAllProductsController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetLatestProductsController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetProductByStoreController;
use App\Http\Controllers\Api\Product\V1\Fetch\ProductDetailsPageController;
use App\Http\Controllers\Api\Customer\V1\Onboarding\CreateNewCustomerController;
use App\Http\Controllers\Api\Customer\V1\ProfileManagement\ResetCustomerPasswordController;

Route::group(['prefix' => 'onboarding'], function () {
    Route::post('/registration', [CreateNewCustomerController::class, 'handle']);
    Route::put('/reset-password', [ResetCustomerPasswordController::class, 'handle']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'home'], function () {
        Route::get('/getAllProducts', [GetAllProductsController::class, 'handle']);
        Route::get('/getProductByStore', [GetProductByStoreController::class, 'handle']);
        Route::get('/hot-sales', [GetHotSalesController::class, 'handle']);
        Route::get('/latest-products', [GetLatestProductsController::class, 'handle']);
        Route::get('/explore', [HomeDashboardController::class, 'handle']);
        Route::get('/product-details', [ProductDetailsPageController::class, 'handle']);
        Route::post('/addToCart', [AddProductToCartController::class, 'handle']);
        Route::get('/fetchCartItems', [FetchCartRecordController::class, 'handle']);
    });
});
