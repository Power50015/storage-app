<?php

use App\Http\Controllers\People\PeopleController;
use Illuminate\Support\Facades\Route;

Route::resource('/people', PeopleController::class);

Route::get('/people-data', [PeopleController::class, 'data']);