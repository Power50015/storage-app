<?php

use App\Http\Controllers\IncomingInvoiceController;
use App\Http\Controllers\ReturnedIncomingInvoiceController;
use Illuminate\Support\Facades\Route;

 // incoming invoice
 Route::resource('/incoming-invoice', IncomingInvoiceController::class);

 Route::resource('/returned-incoming-invoice', ReturnedIncomingInvoiceController::class)->only([
     'edit', 'update'
 ]);