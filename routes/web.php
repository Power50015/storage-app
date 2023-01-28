<?php

use App\Http\Controllers\Driver\DriverController;
use App\Models\Cash\Cash;
use App\Models\Expense\Expense;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    // return redirect()->route('dashboard');
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'totalIncomingInvoice' => IncomingInvoice::count(),
            'totalIncomingInvoiceThisDay' => IncomingInvoice::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->count(),
            'totalIncomingInvoiceThisWeek' => IncomingInvoice::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->count(),
            'totalIncomingInvoiceThisMonth' => IncomingInvoice::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->count(),
            'totalIncomingInvoiceThisYear' => IncomingInvoice::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->count(),
            'totalOutgoingInvoice' => OutgoingInvoice::count(),
            'totalOutgoingInvoiceThisDay' => OutgoingInvoice::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->count(),
            'totalOutgoingInvoiceThisWeek' => OutgoingInvoice::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->count(),
            'totalOutgoingInvoiceThisMonth' => OutgoingInvoice::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->count(),
            'totalOutgoingInvoiceThisYear' => OutgoingInvoice::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->count(),
            "totalCashesWay" => Cash::count(),
            "totalCashes" => Cash::sum('available'),
            'totalExpense' => Expense::count(),
            'totalExpenseThisDay' => Expense::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->sum('amount'),
            'totalExpenseThisWeek' => Expense::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->sum('amount'),
            'totalExpenseThisMonth' => Expense::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->sum('amount'),
            'totalExpenseThisYear' => Expense::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->sum('amount'),

        ]);
    })->name('dashboard');

    // Driver
    Route::resource('/driver', DriverController::class)->only([
        'store'
    ]);

    Route::Put('/dark-mode', function () {
        $user = User::find(Auth::id());
        $user->dark_mode = !$user->dark_mode;
        $user->save();
        return Redirect::back();
    })->name('dark-mode');

    Route::get('/profile/{id?}', function ($id = null) {
        if ($id) {
            return Inertia::render('Profile', [
                "user" => User::find($id),
            ]);
        } else {
            return Inertia::render('Profile', [
                "user" => User::find(Auth::id()),
            ]);
        }
    })->name('myProfile');
});
