<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\V1\Create\CreateNewProductController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'product-management'], function() {
        Route::post('/create', [CreateNewProductController::class, 'handle']);
    });
});