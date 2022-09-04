<?php

use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseStockController;
use Illuminate\Support\Facades\Route;

Route::resource('/warehouse', WarehouseController::class)->only([
    'index', 'store', 'show', 'update'
]);
Route::resource('/warehouse-stock', WarehouseStockController::class)->only([
    'index', 'create', 'store'
]);
