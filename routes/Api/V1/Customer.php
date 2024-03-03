<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\V1\Onboarding\CreateNewCustomerController;
use App\Http\Controllers\Api\Customer\V1\ProfileManagement\ResetCustomerPasswordController;

Route::group(['prefix' => 'onboarding'], function() {
    Route::post('/registration', [CreateNewCustomerController::class, 'handle']);
    Route::post('/reset-password', [ResetCustomerPasswordController::class, 'handle']);
});




