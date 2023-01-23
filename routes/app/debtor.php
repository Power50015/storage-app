<?php

use App\Http\Controllers\Debtor\DebtorAttachmentController;
use App\Http\Controllers\Debtor\DebtorController;
use App\Http\Controllers\Debtor\DebtorImageController;
use App\Http\Controllers\Debtor\DebtorNoteController;
use App\Http\Controllers\Debtor\DebtorPayAttachmentController;
use App\Http\Controllers\Debtor\DebtorPayController;
use App\Http\Controllers\Debtor\DebtorPayImageController;
use App\Http\Controllers\Debtor\DebtorPayNoteController;
use App\Models\People\People;
use Illuminate\Support\Facades\Route;

Route::resource('/debtor', DebtorController::class);

Route::get('/debtor-people', [DebtorController::class, 'debtorPeople']);
Route::get('/debtor-action', [DebtorController::class, 'debtorAction']);

Route::resource('/debtor-note', DebtorNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/debtor-attachment', DebtorAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/debtor-image', DebtorImageController::class)->only([
    'index', 'store', 'destroy'
]);

 // Debtor Pay
 Route::resource('/debtor-pay', DebtorPayController::class);

Route::resource('/debtor-pay-note', DebtorPayNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/debtor-pay-attachment', DebtorPayAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/debtor-pay-image', DebtorPayImageController::class)->only([
    'index', 'store', 'destroy'
]);