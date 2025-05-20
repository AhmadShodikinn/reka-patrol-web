<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiCriteriaController;
use App\Http\Controllers\Api\ApiDocumentController;
use App\Http\Controllers\Api\ApiInspectionController;
use App\Http\Controllers\Api\ApiSafetyPatrolController;
use App\Http\Controllers\Api\ApiSafetyPatrolRecapController;
use App\Http\Controllers\Api\ApiUserController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function () {
    Route::post('login', [ApiAuthController::class, 'login'])->name('login');
    
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [ApiAuthController::class, 'logout'])->name('logout');
        Route::resource('users', ApiUserController::class);
        Route::resource('criterias', ApiCriteriaController::class);
        Route::resource('inspections', ApiInspectionController::class);
        Route::resource('safety-patrols', ApiSafetyPatrolController::class);
        Route::resource('safety-patrol-recaps', ApiSafetyPatrolRecapController::class);
        Route::resource('documents', ApiDocumentController::class);
        Route::resource('letters', ApiDocumentController::class);
    });
});
