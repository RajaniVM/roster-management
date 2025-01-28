<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RosterEventController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/upload-roster', [RosterEventController::class, 'uploadRoster']);

Route::get('/events', [RosterEventController::class, 'getEventsBetweenDates']);
Route::get('/flights/next-week', [RosterEventController::class, 'getFlightsNextWeek']);
Route::get('/standby/next-week', [RosterEventController::class, 'getStandbyNextWeek']);
Route::get('/flights/location', [RosterEventController::class, 'getFlightsByLocation']);
