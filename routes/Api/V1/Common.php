<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Store\V1\Activation\FetchBanksListController;
use App\Http\Controllers\Api\Store\V1\Activation\VerifyAccountNumberController;
use App\Http\Controllers\Api\Upload\UploadImageController;

Route::group(['prefix' => 'banks'], function(){
    Route::get('/list', [FetchBanksListController::class, 'handle']);
    Route::get('/verify', [VerifyAccountNumberController::class, 'handle']);
});

Route::post('/upload', [UploadImageController::class, 'handle']);