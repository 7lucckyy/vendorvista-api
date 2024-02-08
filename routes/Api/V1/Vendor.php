<?php

use App\Http\Controllers\Api\Vendor\V1\Authentication\AuthenticateVendorController;
use App\Http\Controllers\Api\Vendor\V1\Onboarding\CreateNewVendorController;
use Illuminate\Support\Facades\Route;




Route::group(['prefix' => 'authentication'], function() {
    Route::post('/registration', [CreateNewVendorController::class, 'handle']);
    Route::post('/authenticate', [AuthenticateVendorController::class, 'handle']);
});