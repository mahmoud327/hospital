<?php

use App\Http\Controllers\Api\ServiceProvider\ScheduleController;
use App\Http\Controllers\Api\ServiceProvider\ServiceController;
use App\Http\Controllers\Api\ServiceProvider\ServiceProviderController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth:api')->group(function () {
    Route::post('update-profile', [ServiceProviderController::class, 'updateProfile']);
    Route::post('profile-info', [ServiceProviderController::class, 'ProfileInfo']);
    Route::post('schedules ', [ScheduleController::class, 'store']);

    Route::post('service', [ServiceController::class, 'store']);
    Route::get('services', [ServiceController::class, 'index']);

});
