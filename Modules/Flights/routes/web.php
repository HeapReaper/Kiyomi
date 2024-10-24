<?php

use Illuminate\Support\Facades\Route;
use Modules\Flights\Http\Controllers\FlightsController;
use Modules\Flights\Http\Controllers\FlightsPanelController;

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

Route::group([], function () {
    Route::resource('flights', FlightsController::class)->names('flights');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('flights-panel', FlightsPanelController::class)->names('flights-panel');
});