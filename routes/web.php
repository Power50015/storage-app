<?php

use App\Http\Controllers\CashController;
use App\Http\Controllers\CreditorController;
use App\Http\Controllers\CreditorPayController;
use App\Http\Controllers\DebtorController;
use App\Http\Controllers\DebtorPayController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomingInvoiceController;
use App\Http\Controllers\KitAttachmentController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\KitImageController;
use App\Http\Controllers\KitNoteController;
use App\Http\Controllers\OutgoingInvoiceController;
use App\Http\Controllers\PeopleController;
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
use App\Http\Controllers\ReturnedIncomingInvoiceController;
use App\Http\Controllers\ReturnedOutgoingInvoiceController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseStockController;
use App\Models\ReturnedOutgoingInvoice;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/warehouse', WarehouseController::class)->only([
        'index', 'store', 'show', 'update'
    ]);
    Route::resource('/warehouse-stock', WarehouseStockController::class)->only([
        'index', 'create', 'store'
    ]);
    // Products
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
    // Expense
    Route::resource('/expense', ExpenseController::class)->only([
        'index', 'store'
    ]);
    // People
    Route::resource('/people', PeopleController::class)->only([
        'index', 'store'
    ]);
    // Cash
    Route::resource('/cash', CashController::class)->only([
        'index', 'store'
    ]);
    // incoming invoice
    Route::resource('/incoming-invoice', IncomingInvoiceController::class);
    Route::resource('/returned-incoming-invoice', ReturnedIncomingInvoiceController::class)->only([
        'edit', 'update'
    ]);
    Route::resource('/outgoing-invoice', OutgoingInvoiceController::class);
    Route::resource('/returned-outgoing-invoice', ReturnedOutgoingInvoiceController::class)->only([
        'edit', 'update'
    ]);
    // Debtor
    Route::resource('/debtor', DebtorController::class)->only([
        'index', 'create', 'store'
    ]);
    Route::resource('/debtor-pay', DebtorPayController::class)->only([
        'create', 'store'
    ]);
    // Creditor
    Route::resource('/creditor', CreditorController::class)->only([
        'index', 'create', 'store'
    ]);
    Route::resource('/creditor-pay', CreditorPayController::class)->only([
        'create', 'store'
    ]);
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
    // Driver
    Route::resource('/driver', DriverController::class)->only([
        'store'
    ]);
    // Transfer
    Route::resource('/transfer', TransferController::class)->only([
        'index', 'create', 'store'
    ]);
});
