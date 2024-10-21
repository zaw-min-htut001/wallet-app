<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\UserWalletController;

Route::get('/', function () {
    return view('welcome');
});

// ROUTE FOR USER //
Route::middleware('auth:web')->group(function () {
    // home Page
    Route::get('/home', [UserWalletController::class, 'userHomePage'])->name('dashboard');

    // wallet page
    Route::get('/wallet', [UserWalletController::class, 'index'])->name('userWallet.index');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/profile/info', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
