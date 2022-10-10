<?php

use App\Http\Controllers\Warehouse\WarehouseController;
use App\Http\Controllers\Warehouse\WarehouseStockController;
use Illuminate\Support\Facades\Route;

Route::resource('/warehouse', WarehouseController::class);
Route::resource('/warehouse-stock', WarehouseStockController::class);
