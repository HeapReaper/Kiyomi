<?php

use Illuminate\Support\Facades\Route;
use Modules\Financials\Http\Controllers\FinancialsController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('financials', FinancialsController::class)->names('financials');
});
