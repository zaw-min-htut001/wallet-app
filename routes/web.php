<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\Admin\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

// ROUTE FOR USER //
    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::middleware('auth:web')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// Admin routes //
Route::middleware('preventUserAccessAdmin')->group(function () {
    Route::middleware('guest:admin_user')->prefix('admin')->group( function () {
        Route::get('login', [LoginController::class, 'create'])->name('admin.login');
        Route::post('login', [LoginController::class, 'store'])->name('admin.store');
    });

    Route::middleware('auth:admin_user')->prefix('admin')->group( function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');;
    });

});

require __DIR__.'/auth.php';
