<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\QrController;
use App\Http\Controllers\Frontend\TransferController;
use App\Http\Controllers\Frontend\UserWalletController;
use App\Http\Controllers\Frontend\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

// ROUTE FOR USER //
Route::middleware('auth:web')->group(function () {
    // home Page
    Route::get('/home', [UserWalletController::class, 'userHomePage'])->name('dashboard');

    // wallet page
    Route::get('/wallet', [UserWalletController::class, 'index'])->name('userWallet.index');

    // transfer page
    Route::get('/transfer', [TransferController::class, 'index'])->name('transfer.index');
    Route::post('/transfer/verify-number', [TransferController::class, 'verifyNumber'])->name('transfer.verify');
    Route::get('/transfer/transfer-to', [TransferController::class, 'transferTo'])->name('transfer.transferTo');
    Route::post('/transfer', [TransferController::class, 'transfer'])->name('transfer.transfer');
    Route::post('/transfer/comfirm', [TransferController::class, 'comfirm'])->name('transfer.comfirm');

    // transaction page
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/{transaction}', [TransactionController::class, 'show'])->name('transaction.show');

    // sacn Qr page
    Route::get('/receive-qr', [QrController::class, 'index'])->name('qr.index');
    Route::get('/scan-qr', [QrController::class, 'scanPage'])->name('qr.scanPage');

});


Route::middleware('auth:web')->group(function () {
    Route::get('/profile/info', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
