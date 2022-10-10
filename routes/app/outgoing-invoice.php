<?php

use App\Http\Controllers\OutgoingInvoice\OutgoingInvoiceController;
use App\Http\Controllers\OutgoingInvoice\ReturnedOutgoingInvoiceController;
use Illuminate\Support\Facades\Route;

Route::resource('/outgoing-invoice', OutgoingInvoiceController::class);
Route::resource('/returned-outgoing-invoice', ReturnedOutgoingInvoiceController::class)->only([
    'edit', 'update'
]);
