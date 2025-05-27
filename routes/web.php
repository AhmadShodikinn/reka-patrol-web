<?php

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'profile')->name('welcome');


// Routes untuk User dengan Middleware 'auth'
Route::middleware('auth')->group(function () {

    Route::resource('users', UsersController::class);
    Route::resource('criterias', CriteriaController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('letters', DocumentController::class);


    // Routes untuk Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
