<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RosterEventController;

Route::get('/', function () {
    return view('welcome');
});

