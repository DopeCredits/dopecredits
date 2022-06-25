<?php

use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('wallet/stakingresult', [WalletController::class, 'stakingresult']);
