<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Vendor\V1\Authentication\AuthenticateVendorController;
use App\Http\Controllers\Api\Customer\V1\Authentication\AuthenticateCustomerController;

Route::group(['prefix' => 'authentication'], function() {
    Route::post('/authenticate', [AuthenticateCustomerController::class, 'handle']);
});