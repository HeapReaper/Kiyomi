<?php

use Illuminate\Support\Facades\Route;
use Modules\Media\Http\Controllers\MediaController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('media', MediaController::class)->names('media');
});
