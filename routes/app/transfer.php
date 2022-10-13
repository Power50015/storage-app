<?php

use App\Http\Controllers\Transfer\TransferController;
use Illuminate\Support\Facades\Route;

Route::resource('/transfer', TransferController::class);
