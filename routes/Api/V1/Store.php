<?php

use App\Http\Controllers\Api\Store\V1\Onboarding\CreateNewStoreController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'authentication'], function () {
        Route::post('/registration', [CreateNewStoreController::class, 'handle']);
    });
});
