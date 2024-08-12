<?php

use App\Http\Controllers\Api\Store\V1\Activation\FetchBanksListController;
use App\Http\Controllers\Api\Store\V1\Activation\VerifyAccountNumberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'banks'], function(){
    Route::get('/list', [FetchBanksListController::class, 'handle']);
    Route::get('/verify', [VerifyAccountNumberController::class, 'handle']);
});