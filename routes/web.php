<?php

use App\Http\Controllers\CashController;
use App\Http\Controllers\CreditorController;
use App\Http\Controllers\CreditorPayController;
use App\Http\Controllers\DebtorController;
use App\Http\Controllers\DebtorPayController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\TransferController;
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
    
    // Driver
    Route::resource('/driver', DriverController::class)->only([
        'store'
    ]);
    // Transfer
    Route::resource('/transfer', TransferController::class)->only([
        'index', 'create', 'store'
    ]);
});
