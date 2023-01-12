<?php

use App\Http\Controllers\IncomingInvoice\IncomingInvoiceAttachmentController;
use App\Http\Controllers\IncomingInvoice\IncomingInvoiceController;
use App\Http\Controllers\IncomingInvoice\IncomingInvoiceImageController;
use App\Http\Controllers\IncomingInvoice\IncomingInvoiceNoteController;
// returned incoming invoice
use App\Http\Controllers\ReturnedIncomingInvoice\ReturnedIncomingInvoiceController;
use App\Http\Controllers\ReturnedIncomingInvoice\ReturnedIncomingInvoiceImageController;
use App\Http\Controllers\ReturnedIncomingInvoice\ReturnedIncomingInvoiceNoteController;
use App\Http\Controllers\ReturnedIncomingInvoice\ReturnedIncomingInvoiceAttachmentController;
use Illuminate\Support\Facades\Route;

// incoming invoice
Route::resource('/incoming-invoice', IncomingInvoiceController::class);

Route::resource('/incoming-invoice-note', IncomingInvoiceNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/incoming-invoice-attachment', IncomingInvoiceAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/incoming-invoice-image', IncomingInvoiceImageController::class)->only([
    'index', 'store', 'destroy'
]);


// returned incoming invoice
Route::resource('/returned-incoming-invoice', ReturnedIncomingInvoiceController::class);
Route::resource('/returned-incoming-invoice-note', ReturnedIncomingInvoiceNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/returned-incoming-invoice-attachment', ReturnedIncomingInvoiceAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/returned-incoming-invoice-image', ReturnedIncomingInvoiceImageController::class)->only([
    'index', 'store', 'destroy'
]);
