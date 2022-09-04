<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductAttachmentController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductCollectionController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCountryController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductMaterialController;
use App\Http\Controllers\ProductModelController;
use App\Http\Controllers\ProductNoteController;
use App\Http\Controllers\ProductTypeController;

Route::resource('/product', ProductController::class);
Route::resource('/product-note', ProductNoteController::class)->only([
    'store', 'destroy'
]);
Route::resource('/product-attachment', ProductAttachmentController::class)->only([
    'store', 'destroy'
]);
Route::resource('/product-image', ProductImageController::class)->only([
    'store', 'destroy'
]);
Route::resource('/product-category', ProductCategoryController::class)->only([
    'store'
]);
Route::get('/product-type/{id}', [ProductTypeController::class, 'index']);
Route::post('/product-type', [ProductTypeController::class, 'store'])->name('product-type.store');

Route::get('/product-collection/{id}', [ProductCollectionController::class, 'index']);
Route::post('/product-collection', [ProductCollectionController::class, 'store'])->name('product-collection.store');

Route::get('/product-model/{id}', [ProductModelController::class, 'index']);
Route::post('/product-model', [ProductModelController::class, 'store'])->name('product-model.store');

Route::resource('/product-brand', ProductBrandController::class)->only([
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
