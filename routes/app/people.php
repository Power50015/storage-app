<?php

use App\Exports\PeopleExport;
use App\Http\Controllers\People\PeopleController;
use App\Http\Controllers\People\PeopleAttachmentController;
use App\Http\Controllers\People\PeopleImageController;
use App\Http\Controllers\People\PeopleNoteController;
use App\Models\People\People;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

Route::resource('/people', PeopleController::class);

Route::get('/people-data', [PeopleController::class, 'data']); // For Dropdown Select

Route::get('/people-action', [PeopleController::class, 'action']);

Route::get('/people-action-details', [PeopleController::class, 'actionDetails']);

Route::resource('/people-note', PeopleNoteController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/people-attachment', PeopleAttachmentController::class)->only([
    'index', 'store', 'destroy'
]);
Route::resource('/people-image', PeopleImageController::class)->only([
    'index', 'store', 'destroy'
]);

Route::get('/people-excel/{id}', function ($id) {
    return Excel::download(new PeopleExport($id), 'people' . Carbon::now() . '-' . Str::random(40) . '.xlsx');
})->name('people-excel');
