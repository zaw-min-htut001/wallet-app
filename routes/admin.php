<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\AdminUserController;

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

        Route::resource('user', AdminUserController::class);
    });

});

