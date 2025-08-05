<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\SettingsController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('settings', SettingsController::class)->names('settings');
});
