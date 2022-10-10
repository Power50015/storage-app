<?php

use App\Http\Controllers\Cash\CashController;
use Illuminate\Support\Facades\Route;

Route::resource('/cash', CashController::class);
