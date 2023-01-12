<?php

use App\Http\Controllers\Cash\CashController;
use App\Http\Controllers\Cash\CashAttachmentController;
use App\Http\Controllers\Cash\CashImageController;
use App\Http\Controllers\Cash\CashNoteController;
use App\Http\Controllers\Cash\CashPayAttachmentController;
use App\Http\Controllers\Cash\CashPayImageController;
use App\Http\Controllers\Cash\CashPayNoteController;
use App\Models\Cash\CashPay;
use Illuminate\Support\Facades\Route;

Route::resource('/cash', CashController::class);
Route::resource('/cash-note', CashNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/cash-attachment', CashAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/cash-image', CashImageController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('/cash-pay', CashPay::class);
Route::resource('/cash-pay-note', CashPayNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/cash-pay-attachment', CashPayAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/cash-pay-image', CashPayImageController::class)->only([
    'index', 'store', 'destroy'
]);