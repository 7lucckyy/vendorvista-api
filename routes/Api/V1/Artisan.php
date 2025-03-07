<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Artisan\V1\Fetch\FetchAllArtisansController;
use App\Http\Controllers\Api\Artisan\V1\Profile\FetchArtisanProfileController;
use App\Http\Controllers\Api\Artisan\V1\Activation\AccountActivationController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/activate', [AccountActivationController::class, 'handle']);
    Route::get('/profile', [FetchArtisanProfileController::class, 'handle']);
    Route::get('/all', [FetchAllArtisansController::class, 'handle']);
});