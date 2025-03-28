<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Upload\UploadImageController;
use App\Http\Controllers\Api\Store\V1\Activation\FetchBanksListController;
use App\Http\Controllers\Api\Store\V1\Activation\VerifyAccountNumberController;
use App\Http\Controllers\Api\Customer\V1\Authentication\VerifyOtpTokenController;
use App\Http\Controllers\Api\Customer\V1\Authentication\RequestOtpTokenController;


Route::group(['prefix' => 'banks'], function(){
    Route::get('/list', [FetchBanksListController::class, 'handle']);
    Route::get('/verify', [VerifyAccountNumberController::class, 'handle']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'auth'], function(){
        Route::post('/verify-otp', action: [VerifyOtpTokenController::class, 'handle']);
        Route::post('/otp-request', action: [RequestOtpTokenController::class, 'handle']);
    });
    Route::post('/upload', [UploadImageController::class, 'handle']);

});

