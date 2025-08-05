<?php

use Illuminate\Support\Facades\Route;
use Modules\Mail\Http\Controllers\MailController;
use Modules\Mail\Http\Controllers\EmailTestController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('mail', MailController::class)->names('mail');
    Route::post('/test-email', [EmailTestController::class, 'sendTestMail']);
});

