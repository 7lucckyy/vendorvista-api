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
Route::group(['verification'], function(){
    Route::post('/otp-request', action: [RequestOtpTokenController::class, 'handle']);
    Route::post('/verify-otp', [VerifyOtpTokenController::class, 'handle']);
});

Route::post('/upload', [UploadImageController::class, 'handle']);