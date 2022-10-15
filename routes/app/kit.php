<?php

use App\Http\Controllers\Kit\KitAttachmentController;
use App\Http\Controllers\Kit\KitController;
use App\Http\Controllers\Kit\KitImageController;
use App\Http\Controllers\Kit\KitNoteController;
use Illuminate\Support\Facades\Route;

// Kit
Route::resource('/kit', KitController::class);
Route::get('/kit-action', [KitController::class, 'actionData']);
Route::get('/kit-stock', [KitController::class, 'stockData']);

Route::resource('/kit-note', KitNoteController::class);
Route::resource('/kit-attachment', KitAttachmentController::class);
Route::resource('/kit-image', KitImageController::class);
