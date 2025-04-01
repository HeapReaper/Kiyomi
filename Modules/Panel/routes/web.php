<?php

use Illuminate\Support\Facades\Route;
use Modules\Panel\Http\Controllers\PanelController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('panel', PanelController::class)->names('panel');
});
