<?php

use App\Http\Controllers\Api\User\Auth\AuthController;
use App\Http\Controllers\Api\User\MedicalRecordController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    Route::post('profile-info', [UserController::class, 'ProfileInfo']);
    Route::apiResource('medical-records', MedicalRecordController::class);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::apiResource('orders', OrderController::class);

});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('resend-code', [AuthController::class, 'resendCode']);
    Route::post('verify-code', [AuthController::class, 'verifyCode']);

    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'AuthController@logout');
    });
});
