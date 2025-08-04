<?php

use Illuminate\Support\Facades\Route;
use Modules\Mail\Http\Controllers\MailController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('mail', MailController::class)->names('mail');
});
