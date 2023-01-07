<?php

use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\Expense\ExpenseAttachmentController;
use App\Http\Controllers\Expense\ExpenseImageController;
use App\Http\Controllers\Expense\ExpenseNoteController;

use Illuminate\Support\Facades\Route;

Route::resource('/expense', ExpenseController::class);

Route::resource('/expense-note', ExpenseNoteController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('/expense-attachment', ExpenseAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/expense-image', ExpenseImageController::class)->only([
    'index', 'store', 'destroy'
]);