<?php

use App\Http\Controllers\IncomingInvoice\IncomingInvoiceAttachmentController;
use App\Http\Controllers\IncomingInvoice\IncomingInvoiceController;
use App\Http\Controllers\IncomingInvoice\IncomingInvoiceImageController;
use App\Http\Controllers\IncomingInvoice\IncomingInvoiceNoteController;
use App\Http\Controllers\IncomingInvoice\ReturnedIncomingInvoiceController;
use Illuminate\Support\Facades\Route;

 // incoming invoice
 Route::resource('/incoming-invoice', IncomingInvoiceController::class);

 Route::resource('/returned-incoming-invoice', ReturnedIncomingInvoiceController::class)->only([
     'edit', 'update'
 ]);

 Route::resource('/incoming-invoice-note',IncomingInvoiceNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/incoming-invoice-attachment', IncomingInvoiceAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/incoming-invoice-image', IncomingInvoiceImageController::class)->only([
    'index', 'store', 'destroy'
]);