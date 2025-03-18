<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiSafetyPatrolController;
use App\Http\Controllers\Api\ApiUserController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function () {
    Route::post('login', [ApiAuthController::class, 'login'])->name('login');
    
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [ApiAuthController::class, 'logout'])->name('logout');
        Route::resource('users', ApiUserController::class);
        Route::resource('safety-patrols', ApiSafetyPatrolController::class);
    });
});
