<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductTypeController;
use App\Http\Controllers\Product\ProductBrandController;
use App\Http\Controllers\Product\ProductCollectionController;
use App\Http\Controllers\Product\ProductModelController;
use App\Http\Controllers\Product\ProductColorController;
use App\Http\Controllers\Product\ProductMaterialController;
use App\Http\Controllers\Product\ProductCountryController;
use App\Http\Controllers\Product\ProductController;

use App\Http\Controllers\Product\ProductAttachmentController;
use App\Http\Controllers\Product\ProductImageController;
use App\Http\Controllers\Product\ProductNoteController;


Route::resource('/product-category', ProductCategoryController::class)->only([
    'store'
]);
Route::resource('/product-type', ProductTypeController::class)->only([
    'store'
]);
Route::resource('/product-brand', ProductBrandController::class)->only([
    'store'
]);
Route::resource('/product-collection', ProductCollectionController::class)->only([
    'store'
]);
Route::resource('/product-model', ProductModelController::class)->only([
    'store'
]);
Route::resource('/product-color', ProductColorController::class)->only([
    'store'
]);
Route::resource('/product-material', ProductMaterialController::class)->only([
    'store'
]);
Route::resource('/product-country', ProductCountryController::class)->only([
    'store'
]);

Route::resource('/product', ProductController::class);
/*Route::resource('/product-note', ProductNoteController::class)->only([
    'store', 'destroy'
]);
Route::resource('/product-attachment', ProductAttachmentController::class)->only([
    'store', 'destroy'
]);
Route::resource('/product-image', ProductImageController::class)->only([
    'store', 'destroy'
]);*/

