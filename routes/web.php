<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
