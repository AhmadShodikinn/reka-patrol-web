<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Dashboard (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('users')->name('users.')->group(function () {

        // List all users
        Route::get('/', function () {
            $users = User::with('position:id,position_name')
                ->select('id', 'nip', 'name', 'email', 'position_id')
                ->get()
                ->map(fn($user) => [
                    'id' => $user->id,
                    'nip' => $user->nip,
                    'name' => $user->name,
                    'email' => $user->email,
                    'position' => $user->position?->position_name,
                ]);

            return Inertia::render('Users', [
                'userData' => $users,
                'test' => 'test',
            ]);
        })->name('index');

        // Create form
        Route::get('/create', function () {
            $positions = Position::all();
            return Inertia::render('UsersCreate', [
                'positions' => $positions,
            ]);
        })->name('create');

        // Store new user
        Route::post('/', [UsersController::class, 'store'])->name('store');

        // Show/Edit a user
        Route::get('/{id}', function ($id) {
            $user = User::with('position:id,position_name')
                ->select('id', 'nip', 'name', 'email', 'position_id')
                ->findOrFail($id);

            $positions = Position::all();

            return Inertia::render('UsersEdit', [
                'user' => [
                    'id' => $user->id,
                    'nip' => $user->nip,
                    'name' => $user->name,
                    'email' => $user->email,
                    'position_id' => $user->position_id,
                ],
                'positions' => $positions,
            ]);
        })->name('show');

        // Update user
        Route::put('/{id}', [UsersController::class, 'update'])->name('update');

        // Delete user
        
    });

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Dev/Test Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('dev')->name('dev.')->group(function () {
        Route::get('/calendar', fn () => print('🗿'))->name('calendar');
        Route::get('/chat', fn () => print('🗿'))->name('chat');
        Route::get('/profiles', fn () => print('🗿'))->name('profiles');
        Route::get('/form-elements', fn () => print('🗿'))->name('form-elements');
        Route::get('/basic-tables', fn () => print('🗿'))->name('basic-tables');
        Route::get('/error-404', fn () => print('🗿'))->name('error-404');
        Route::get('/blank', fn () => print('🗿'))->name('blank');
        Route::get('/line-chart', fn () => print('🗿'))->name('line-chart');
        Route::get('/bar-chart', fn () => print('🗿'))->name('bar-chart');
    });

});

require __DIR__.'/auth.php';
