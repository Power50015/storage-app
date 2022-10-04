<?php

use App\Http\Controllers\Kit\KitAttachmentController;
use App\Http\Controllers\Kit\KitController;
use App\Http\Controllers\Kit\KitImageController;
use App\Http\Controllers\Kit\KitNoteController;
use Illuminate\Support\Facades\Route;

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
