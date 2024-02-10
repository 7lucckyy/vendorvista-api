<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Store\V1\Onboarding\CreateNewStoreController;



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'authentication'], function() {
        Route::post('/registration', [CreateNewStoreController::class, 'handle']);
    });
});