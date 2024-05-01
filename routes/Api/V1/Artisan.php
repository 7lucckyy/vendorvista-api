<?php

use App\Http\Controllers\Api\Artisan\V1\Activation\AccountActivationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/activate', [AccountActivationController::class, 'handle']);
});