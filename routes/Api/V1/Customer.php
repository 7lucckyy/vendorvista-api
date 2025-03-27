<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\V1\Fetch\GetHotSalesController;
use App\Http\Controllers\Api\Address\Create\CreateUserCurrentAddress;
use App\Http\Controllers\Api\Cart\V1\Checkout\CartCheckoutController;
use App\Http\Controllers\Api\Cart\V1\Fetch\FetchCartRecordController;
use App\Http\Controllers\Api\Product\V1\Fetch\HomeDashboardController;
use App\Http\Controllers\Api\Product\V1\Fetch\SearchProductController;
use App\Http\Controllers\Api\Cart\V1\Create\AddProductToCartController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetAllProductsController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetLatestProductsController;
use App\Http\Controllers\Api\Product\V1\Fetch\GetProductByStoreController;
use App\Http\Controllers\Api\Product\V1\Fetch\ProductDetailsPageController;
use App\Http\Controllers\Api\Artisan\V1\Activation\AccountActivationController;
use App\Http\Controllers\Api\Order\V1\Fetch\FetchCustomerOrderRecordController;
use App\Http\Controllers\Api\Customer\V1\Onboarding\CreateNewCustomerController;
use App\Http\Controllers\Api\Customer\V1\Authentication\VerifyOtpTokenController;
use App\Http\Controllers\Api\Customer\V1\Authentication\RequestOtpTokenController;
use App\Http\Controllers\Api\Customer\V1\ProfileManagement\UpdateProfileController;
use App\Http\Controllers\Api\Customer\V1\ProfileManagement\FetchCustomerProfileController;
use App\Http\Controllers\Api\Customer\V1\Authentication\ResetPasswordOtp\VerifyResetPasswordOtpController;
use App\Http\Controllers\Api\Customer\V1\Authentication\ResetPasswordOtp\ResetPasswordOtpRequestController;

Route::group(['prefix' => 'onboarding'], function () {
    Route::post('/registration', [CreateNewCustomerController::class, 'handle']);
    Route::post('/request-password-reset', [ResetPasswordOtpRequestController::class, 'handle']);
    Route::put('/password-reset', [VerifyResetPasswordOtpController::class, 'handle']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'home'], function () {
        Route::get('/getAllProducts', [GetAllProductsController::class, 'handle']);
        Route::get('/getProductByStore', [GetProductByStoreController::class, 'handle']);
        Route::get('/hot-sales', [GetHotSalesController::class, 'handle']);
        Route::get('/latest-products', [GetLatestProductsController::class, 'handle']);
        Route::get('/explore', [HomeDashboardController::class, 'handle']);
        Route::get('/search/{search}', [SearchProductController::class, 'handle']);
        Route::get('/product-details/{id}', [ProductDetailsPageController::class, 'handle']);
        Route::post('/addToCart', [AddProductToCartController::class, 'handle']);
        Route::get('/fetchCartItems', [FetchCartRecordController::class, 'handle']);
        Route::get('/orders', [FetchCustomerOrderRecordController::class, 'handle']);
        Route::post('/createCurrentAddress', [CreateUserCurrentAddress::class, 'handle']);
        Route::post('/cart-checkout', [CartCheckoutController::class, 'handle']);
        Route::put('/profile-update', [UpdateProfileController::class, 'handle']);
        Route::get('/profile',[FetchCustomerProfileController::class, 'handle']);
    });
});

