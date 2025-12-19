<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class);
    Route::post('forgot-password', ForgotPasswordController::class);
    Route::post('reset-password', ResetPasswordController::class);
    Route::post('verify-email', VerifyEmailController::class);
    Route::post('verify-phone', VerifyPhoneController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/profile', UserProfileController::class);
    Route::put('/user/profile', UpdateProfileController::class);

    Route::get('/cart', CartController::class);
    Route::post('/cart/add', AddToCartController::class);
    Route::delete('/cart/{id}', RemoveCartController::class);

    Route::post('/orders', CreateOrderController::class);
    Route::get('/orders', OrderListController::class);
});
