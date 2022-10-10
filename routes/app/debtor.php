<?php

use App\Http\Controllers\Debtor\DebtorController;
use App\Http\Controllers\Debtor\DebtorPayController;
use Illuminate\Support\Facades\Route;

Route::resource('/debtor', DebtorController::class);
Route::resource('/debtor-pay', DebtorPayController::class);