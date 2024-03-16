<?php

use App\Http\Controllers\Api\Customer\V1\Authentication\AuthenticateCustomerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication'], function () {
    Route::post('/authenticate', [AuthenticateCustomerController::class, 'handle']);
});
