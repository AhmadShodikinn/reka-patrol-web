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
Route::get('/calendar', [ProfileController::class, 'index'])->name('calendar');
Route::get('/chat', [ProfileController::class, 'index'])->name('chat');
Route::get('/profiles', [ProfileController::class, 'index'])->name('profile');
Route::get('/form-elements', [ProfileController::class, 'index'])->name('form-elements');
Route::get('/basic-tables', [ProfileController::class, 'index'])->name('basic-tables');
Route::get('/error-404', [ProfileController::class, 'index'])->name('error-404');
Route::get('/blank', [ProfileController::class, 'index'])->name('blank');
Route::get('/line-chart', [ProfileController::class, 'index'])->name('line-chart');
Route::get('/bar-chart', [ProfileController::class, 'index'])->name('bar-chart');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
