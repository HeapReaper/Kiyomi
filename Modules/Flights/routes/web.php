<?php

use Illuminate\Support\Facades\Route;
use Modules\Flights\Http\Controllers\FlightsController;
use Modules\Flights\Http\Controllers\FlightsPanelController;
use Modules\Flights\Http\Controllers\FlightsReportController;
use Modules\Flights\Http\Controllers\ImportController;

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
    Route::get('/aanmeld-formulier', [FlightsController::class, 'redirect']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('flights-panel', FlightsPanelController::class)->names('flights-panel');
    Route::resource('flights-reports', FlightsReportController::class)->names('flights-report');
    Route::get('flights-reports/download/{report}', [FlightsReportController::class, 'download']);
});