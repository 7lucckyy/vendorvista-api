<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Artisan\V1\Upload\UploadGalleryController;
use App\Http\Controllers\Api\Artisan\V1\Fetch\FetchAllArtisansController;
use App\Http\Controllers\Api\Artisan\V1\Profile\FetchArtisanProfileController;
use App\Http\Controllers\Api\Artisan\V1\Activation\AccountActivationController;
use App\Http\Controllers\Api\Artisan\V1\ServiceRequest\ServiceRequestController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/activate', [AccountActivationController::class, 'handle']);
    Route::get('/profile', [FetchArtisanProfileController::class, 'handle']);
    Route::get('/all', [FetchAllArtisansController::class, 'handle']);
    Route::post('/gallery', [UploadGalleryController::class, 'handle']);
    Route::post('/request-service', [ServiceRequestController::class, 'handle']);       
});
