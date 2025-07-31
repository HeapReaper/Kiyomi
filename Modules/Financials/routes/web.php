<?php

use Illuminate\Support\Facades\Route;
use Modules\Financials\Http\Controllers\FinancialsController;
use Modules\Financials\Http\Controllers\MemberShipController;
use Modules\Financials\Http\Controllers\PaymentController;
use Modules\Financials\Http\Controllers\RecurringPaymentController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('financials', FinancialsController::class)->names('financials');
	Route::resource('member-ships', MemberShipController::class)->names('member-ships');
	Route::resource('payments', PaymentController::class)->names('payments');
	Route::resource('recurring-payments', RecurringPaymentController::class)->names('recurring-payments');
});
