<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CatgoryController;
use App\Http\Controllers\Api\MedicalTypeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ServiceProviderController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1', 'middleware' => 'lang'], function () {
    Route::get('services/{service_id}/service-providers', [ServiceProviderController::class, 'index']);
    Route::get('service-provider/{id}', [ServiceProviderController::class, 'show']);
    Route::get('sub-services/{parent_id}', [CatgoryController::class, 'getSubCategories']);
    Route::apiResource('services', CatgoryController::class);
    Route::apiResource('medical-types', MedicalTypeController::class);
    Route::apiResource('banners', BannerController::class);
    Route::apiResource('blogs', BlogController::class);
    Route::apiResource('tags', TagController::class);

});
