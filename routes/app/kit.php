<?php

use App\Http\Controllers\KitAttachmentController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\KitImageController;
use App\Http\Controllers\KitNoteController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // Kit
    Route::resource('/kit', KitController::class);
    Route::resource('/kit-note', KitNoteController::class)->only([
        'store', 'destroy'
    ]);
    Route::resource('/kit-attachment', KitAttachmentController::class)->only([
        'store', 'destroy'
    ]);
    Route::resource('/kit-image', KitImageController::class)->only([
        'store', 'destroy'
    ]);
});
