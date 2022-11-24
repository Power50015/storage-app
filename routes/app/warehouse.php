<?php

use App\Http\Controllers\Warehouse\WarehouseAttachmentController;
use App\Http\Controllers\Warehouse\WarehouseController;
use App\Http\Controllers\Warehouse\WarehouseImageController;
use App\Http\Controllers\Warehouse\WarehouseNoteController;
use App\Http\Controllers\Warehouse\WarehouseStockController;
use App\Http\Controllers\Warehouse\WarehouseStockAttachmentController;
use App\Http\Controllers\Warehouse\WarehouseStockImageController;
use App\Http\Controllers\Warehouse\WarehouseStockNoteController;
use Illuminate\Support\Facades\Route;

Route::resource('/warehouse', WarehouseController::class);
Route::get('/warehouse-empty-total', [WarehouseController::class, 'isEmptyCount']);
Route::resource('/warehouse-attachment', WarehouseAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/warehouse-image', WarehouseImageController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/warehouse-note', WarehouseNoteController::class)->only([
    'index', 'store', 'destroy'
]);

Route::get('/warehouse-data', [WarehouseController::class, 'stockData']);
Route::get('/warehouse-action', [WarehouseController::class, 'actionData']);
Route::get('/warehouse-action-details', [WarehouseController::class, 'warehouseActionDetails']);
Route::get('/warehouse-destructible-goods', [WarehouseController::class, 'destructibleGoods'])->name('warehouse-destructible-goods');

Route::resource('/warehouse-stock', WarehouseStockController::class);
Route::resource('/warehouse-stock-attachment', WarehouseStockAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/warehouse-stock-image', WarehouseStockImageController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/warehouse-stock-note', WarehouseStockNoteController::class)->only([
    'index', 'store', 'destroy'
]);
