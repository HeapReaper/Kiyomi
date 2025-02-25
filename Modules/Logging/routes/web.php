<?php

use Illuminate\Support\Facades\Route;
use Modules\Logging\Http\Controllers\LoggingController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('logging', LoggingController::class)->names('logging');
});
