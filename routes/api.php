<?php

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

Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::post('logout', [\App\Http\Controllers\RegisterController::class, 'logout']);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('addresses', \App\Http\Controllers\AddressController::class);
    Route::resource('phones', \App\Http\Controllers\PhoneController::class);
    Route::resource('social_media', \App\Http\Controllers\SocialMediaController::class);
});