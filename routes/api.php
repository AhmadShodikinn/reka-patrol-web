<?php

use App\Http\Controllers\Api\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function () {
    Route::post('login', [ApiAuthController::class, 'login'])->name('login');
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
