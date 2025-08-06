<?php

use Illuminate\Support\Facades\Route;
use Modules\Flights\Http\Controllers\FlightsController;
use Modules\Flights\Http\Controllers\FlightsPanelController;
use Modules\Flights\Http\Controllers\FlightsReportController;
use Modules\Flights\Http\Controllers\FlightsStatisticsController;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::middleware(CacheResponse::class)->group(function () {
    Route::resource('flights', FlightsController::class)->names('flights');
    Route::get('/flights', [FlightsController::class, 'index']);
    Route::get('/aanmeld-formulier', [FlightsController::class, 'redirect']);
});

Route::middleware(['auth', CacheResponse::class])->group(function () {
    Route::resource('flights-panel', FlightsPanelController::class)->names('flights-panel');
    Route::resource('flights-reports', FlightsReportController::class)->names('flights-report');
    Route::get('flights-reports/download/{report}', [FlightsReportController::class, 'download']);
    Route::get('flights-reports/destroy/{id}', [FlightsReportController::class, 'destroy']);
    Route::resource('flights-statistics', FlightsStatisticsController::class)->names('flights-statistics');
});