<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\JSAController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', 'dashboard')->name('welcome');

// tes🗿
Route::get('/calendar', fn() => print('🗿'))->name('calendar');
Route::get('/chat', fn() => print('🗿'))->name('chat');
Route::get('/profiles', fn() => print('🗿'))->name('profile');
Route::get('/form-elements', fn() => print('🗿'))->name('form-elements');
Route::get('/basic-tables', fn() => print('🗿'))->name('basic-tables');
Route::get('/error-404', fn() => print('🗿'))->name('error-404');
Route::get('/blank', fn() => print('🗿'))->name('blank');
Route::get('/line-chart', fn() => print('🗿'))->name('line-chart');
Route::get('/bar-chart', fn() => print('🗿'))->name('bar-chart');

// Routes untuk User dengan Middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('users', UsersController::class);
    // Route::resource('JSA', JSAController::class);

    Route::resource('/documents', DocumentController::class);

    // Routes untuk Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
