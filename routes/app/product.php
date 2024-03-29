<?php

use App\Http\Controllers\Product\DestructibleGoodsActionController;
use App\Http\Controllers\Product\DestructibleGoodsController;
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

Route::resource('/product-category', ProductCategoryController::class);
Route::resource('/product-type', ProductTypeController::class);

Route::resource('/product-collection', ProductCollectionController::class);
Route::resource('/product-model', ProductModelController::class);
Route::resource('/product-color', ProductColorController::class);
Route::resource('/product-material', ProductMaterialController::class);
Route::resource('/product-country', ProductCountryController::class);
Route::resource('/product-brand', ProductBrandController::class);
Route::get('/product-brand-data', [ProductBrandController::class, 'data']);

Route::get('/product-data', [ProductController::class, 'data']); // For Dropdown Select
Route::resource('/product', ProductController::class);
Route::resource('/product-note', ProductNoteController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('/product-attachment', ProductAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('/product-image', ProductImageController::class)->only([
    'index', 'store', 'destroy'
]);

Route::get('/product-stock', [ProductController::class, 'stockData']);
Route::get('/product-action', [ProductController::class, 'actionData']);
Route::get('/product-kits', [ProductController::class, 'kits']);

Route::resource('/destructible-goods', DestructibleGoodsController::class);
Route::resource('/destructible-goods-action', DestructibleGoodsActionController::class);