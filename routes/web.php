<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'home'])->name('home');
Route::post('/contact', [AppController::class, 'contact'])->name('contact');
Route::get('/staking', [AppController::class, 'staking'])->name('staking');
Route::post('/wallet/store', [WalletController::class, 'store'])->name('wallet.store');
Route::post('/wallet/secret', [WalletController::class, 'secret'])->name('wallet.secret');
Route::get('/wallet/disconnect', [WalletController::class, 'disconnect'])->name('wallet.disconnect');

Route::post('/wallet/staking', [WalletController::class, 'staking'])->name('wallet.staking');
Route::post('/wallet/submitXdr', [WalletController::class, 'submitXdr'])->name('wallet.submitXdr');
