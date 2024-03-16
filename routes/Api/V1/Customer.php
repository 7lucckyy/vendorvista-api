<?php

use App\Http\Controllers\Api\Customer\V1\Onboarding\CreateNewCustomerController;
use App\Http\Controllers\Api\Customer\V1\ProfileManagement\ResetCustomerPasswordController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'onboarding'], function () {
    Route::post('/registration', [CreateNewCustomerController::class, 'handle']);
    Route::post('/reset-password', [ResetCustomerPasswordController::class, 'handle']);
});
