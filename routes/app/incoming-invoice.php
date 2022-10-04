<?php

use App\Http\Controllers\IncomingInvoice\IncomingInvoiceController;
use App\Http\Controllers\IncomingInvoice\ReturnedIncomingInvoiceController;
use Illuminate\Support\Facades\Route;

 // incoming invoice
 Route::resource('/incoming-invoice', IncomingInvoiceController::class);

 Route::resource('/returned-incoming-invoice', ReturnedIncomingInvoiceController::class)->only([
     'edit', 'update'
 ]);