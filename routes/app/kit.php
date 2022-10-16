<?php

use App\Http\Controllers\Kit\KitAttachmentController;
use App\Http\Controllers\Kit\KitController;
use App\Http\Controllers\Kit\KitImageController;
use App\Http\Controllers\Kit\KitNoteController;
use App\Http\Controllers\Kit\KitOperationController;
use Illuminate\Support\Facades\Route;

// Kit
Route::resource('/kit', KitController::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update'
]);
Route::get('/kit-action', [KitController::class, 'actionData']);
Route::get('/kit-stock', [KitController::class, 'stockData']);

Route::resource('/kit-note', KitNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/kit-attachment', KitAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/kit-image', KitImageController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('/kit-operation', KitOperationController::class)->only([
    'update', 'store', 'destroy'
]);
