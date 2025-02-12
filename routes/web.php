<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\StakingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'home'])->name('home');
Route::post('/contact', [AppController::class, 'contact'])->name('contact');

//Storing wallets connecting from extensions like rabet etc
Route::post('/wallet/store', [WalletController::class, 'store'])->name('wallet.store');

//Storing wallets connecting from secret key
Route::post('/wallet/secret', [WalletController::class, 'secret'])->name('wallet.secret');

Route::get('/wallet/disconnect', [WalletController::class, 'disconnect'])->name('wallet.disconnect');
Route::get('/fetch_dashboard_data', [WalletController::class, 'fetch_dashboard_data']);
Route::get('/fetch_wallet_data/{wallet_address?}', [WalletController::class, 'fetch_wallet_data']);
Route::get('/wallet_activity/{wallet_address?}', [WalletController::class, 'wallet_activity']);

Route::post('/wallet/invest', [WalletController::class, 'invest'])->name('wallet.invest');
Route::post('/wallet/submitXdr', [WalletController::class, 'submitXdr'])->name('wallet.submitXdr');
Route::post('/stop_staking/{wallet_address?}', [WalletController::class, 'stop_staking'])->name('stop_staking');

Route::get('/dashboard', function() {
    return view('staking-dashboard');
})->name('dashboard');
