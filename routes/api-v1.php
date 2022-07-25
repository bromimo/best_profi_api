<?php

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

Route::prefix('auth')->group(function () {
    Route::post('signup', \App\Http\Controllers\Api\V1\Auth\SignupController::class);
    Route::post('signin', \App\Http\Controllers\Api\V1\Auth\SigninController::class);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('signout', \App\Http\Controllers\Api\V1\Auth\SignoutController::class);
    });
});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('journal')->group(function () {
        Route::prefix('add')->group(function () {
            Route::post('subject', \App\Http\Controllers\Api\V1\Journal\AddSubjectController::class);
        });
    });
});