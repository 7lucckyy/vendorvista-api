<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\V1\Onboarding\CreateNewCustomerController;
use App\Http\Controllers\Api\Customer\V1\Authentication\AuthenticateCustomerController;

Route::group(['prefix' => 'authentication'], function() {
    Route::post('/registration', [CreateNewCustomerController::class, 'handle']);
    Route::post('/authenticate', [AuthenticateCustomerController::class, 'handle']);

});





?>