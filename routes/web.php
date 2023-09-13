<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SubServiceController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('login-page', 'AuthController@loginPage')->name('admin.login.page');
        Route::post('login', 'AuthController@login')->name('admin.login');
        Route::get('logout', 'AuthController@logout')->name('admin.logout');

        Route::group(['middleware' => ['admin']], function () {
            Route::get('home', 'HomeController@index')->name('admin.home');

            //route-for-services

            Route::resource('users', UserController::class);
            Route::resource('blogs', BlogController::class);
            Route::resource('banners', BannerController::class);

            Route::resource('services', ServiceController::class);
            Route::resource('tags', TagController::class);
            


            Route::get('services/sub-categories/{parent_id?}', [SubServiceController::class, 'index'])->name('service.sub-services');
            Route::post('services/sub-categories/{parent_id?}', [SubServiceController::class, 'store'])->name('service.sub-services.store');
        });
    });
});
