<?php

use App\Http\Controllers\Creditor\CreditorController;
use App\Http\Controllers\Creditor\CreditorAttachmentController;
use App\Http\Controllers\Creditor\CreditorImageController;
use App\Http\Controllers\Creditor\CreditorNoteController;
use App\Http\Controllers\Creditor\CreditorPayController;
use App\Http\Controllers\Creditor\CreditorPayNoteController;
use App\Http\Controllers\Creditor\CreditorPayAttachmentController;
use App\Http\Controllers\Creditor\CreditorPayImageController;
use App\Models\People\People;
use Illuminate\Support\Facades\Route;

 // Creditor
 Route::resource('/creditor', CreditorController::class);

 Route::get('/creditor-people', [CreditorController::class, 'creditorPeople']);
Route::get('/creditor-action', [CreditorController::class, 'creditorAction']);

Route::get('/creditor-total', function () {
    return People::get()->where('total_credit', '<', 0)->sum('total_credit');
});

Route::resource('/creditor-note', CreditorNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/creditor-attachment', CreditorAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/creditor-image', CreditorImageController::class)->only([
    'index', 'store', 'destroy'
]);

 // Creditor Pay
Route::resource('/creditor-pay', CreditorPayController::class);

Route::resource('/creditor-pay-note', CreditorPayNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/creditor-pay-attachment', CreditorPayAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/creditor-pay-image', CreditorPayImageController::class)->only([
    'index', 'store', 'destroy'
]);