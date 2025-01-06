<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'home'])->name('home');
Route::post('/contact', [AppController::class, 'contact'])->name('contact');
// Route::get('/invest', [AppController::class, 'invest'])->name('invest');
// Route::get('/investing', [AppController::class, 'test'])->name('investing');

//Storing wallets connecting from extensions like rabet etc
Route::post('/wallet/store', [WalletController::class, 'store'])->name('wallet.store');

//Storing wallets connecting from secret key
Route::post('/wallet/secret', [WalletController::class, 'secret'])->name('wallet.secret');

Route::get('/wallet/disconnect', [WalletController::class, 'disconnect'])->name('wallet.disconnect');
Route::get('/fetching_staking_data', [WalletController::class, 'fetch_staking_data']);

Route::post('/wallet/invest', [WalletController::class, 'invest'])->name('wallet.invest');
Route::post('/wallet/submitXdr', [WalletController::class, 'submitXdr'])->name('wallet.submitXdr');
