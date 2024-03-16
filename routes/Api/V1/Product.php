<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\V1\Fetch\GetHotSalesController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetAllProductsController;
use App\Http\Controllers\Api\Product\V1\Create\CreateNewProductController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetLatestProductsController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetProductByStoreController;
use App\Http\Controllers\Api\Product\V1\Fetch\VendorDashboardProductsController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'product-management'], function () {
        Route::post('/create', [CreateNewProductController::class, 'handle']);
        Route::get('/getAllProducts', [GetAllProductsController::class, 'handle']);
        Route::get('/getProductByStore', [GetProductByStoreController::class, 'handle']);
        Route::get('/hot-sales', [GetHotSalesController::class, 'handle']);
        Route::get('/latest-products', [GetLatestProductsController::class, 'handle']);
        Route::get('/getAllVendorProducts', [VendorDashboardProductsController::class, 'handle']);
    });
});
