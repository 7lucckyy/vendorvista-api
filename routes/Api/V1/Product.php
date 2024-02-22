<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\V1\Create\CreateNewProductController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetAllProductsController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetProductByStoreController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'product-management'], function() {
        Route::post('/create', [CreateNewProductController::class, 'handle']);
        Route::get('/getAllProducts', [GetAllProductsController::class, 'handle']);
        Route::get('/getProductByStore', [GetProductByStoreController::class, 'handle']);
    });
});