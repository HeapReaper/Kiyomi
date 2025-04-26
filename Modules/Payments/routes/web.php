<?php

use Illuminate\Support\Facades\Route;
use Modules\Payments\Http\Controllers\PaymentsController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('payments', PaymentsController::class)->names('payments');
});
