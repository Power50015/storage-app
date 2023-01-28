<?php

use App\Http\Controllers\Transfer\TransferAttachmentController;
use App\Http\Controllers\Transfer\TransferController;
use App\Http\Controllers\Transfer\TransferImageController;
use App\Http\Controllers\Transfer\TransferNoteController;
use Illuminate\Support\Facades\Route;

Route::resource('/transfer', TransferController::class);

Route::resource('/transfer-note', TransferNoteController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('/transfer-attachment', TransferAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('/transfer-image', TransferImageController::class)->only([
    'index', 'store', 'destroy'
]);

