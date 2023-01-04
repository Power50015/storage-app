<?php

use App\Http\Controllers\OutgoingInvoice\OutgoingInvoiceAttachmentController;
use App\Http\Controllers\OutgoingInvoice\OutgoingInvoiceController;
use App\Http\Controllers\OutgoingInvoice\OutgoingInvoiceImageController;
use App\Http\Controllers\OutgoingInvoice\OutgoingInvoiceNoteController;
use App\Http\Controllers\OutgoingInvoice\ReturnedOutgoingInvoiceController;
use Illuminate\Support\Facades\Route;

 // outgoing invoice
 Route::resource('/outgoing-invoice', OutgoingInvoiceController::class);

 Route::resource('/returned-outgoing-invoice', ReturnedOutgoingInvoiceController::class)->only([
     'edit', 'update'
 ]);

 Route::resource('/outgoing-invoice-note',OutgoingInvoiceNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/outgoing-invoice-attachment', OutgoingInvoiceAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/outgoing-invoice-image', OutgoingInvoiceImageController::class)->only([
    'index', 'store', 'destroy'
]);