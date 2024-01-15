<?php

use App\Http\Controllers\Api\ServiceProvider\NotificationController;
use App\Http\Controllers\Api\ServiceProvider\OrderController;
use App\Http\Controllers\Api\ServiceProvider\ScheduleController;
use App\Http\Controllers\Api\ServiceProvider\ServiceController;
use App\Http\Controllers\Api\ServiceProvider\ServiceProviderController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth:api')->group(function () {
    Route::post('update-profile', [ServiceProviderController::class, 'updateProfile']);
    Route::post('profile-info', [ServiceProviderController::class, 'ProfileInfo']);
    Route::post('schedules ', [ScheduleController::class, 'store']);

    Route::post('service', [ServiceController::class, 'store']);
    Route::apiResource('services', ServiceController::class)->except('store');
    Route::apiResource('orders', OrderController::class);

    Route::get('notifications-read', [NotificationController::class, 'index']);
    Route::get('notifications-unread', [NotificationController::class, 'unread']);
    Route::post('notifications-read', [NotificationController::class, 'read']);


});
