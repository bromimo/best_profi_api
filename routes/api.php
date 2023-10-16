<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\SubjectController;

Route::prefix('auth')->group(function () {
    Route::post('signin', [AuthController::class, 'signIn'])->name('auth.signin');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('signout', [AuthController::class, 'signOut'])->name('auth.signout');
    Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::prefix('users')->group(function () {
        Route::prefix('{user}')->group(function () {
            Route::post('schedules', [ScheduleController::class, 'store'])->name('users.schedules.store');
        });
    });
    Route::singleton('users.schedules', ScheduleController::class)->destroyable()->except('edit');
    Route::apiResources([
        'users'    => UserController::class,
        'subjects' => SubjectController::class,
    ]);
});