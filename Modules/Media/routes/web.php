<?php

use Illuminate\Support\Facades\Route;
use Modules\Media\Http\Controllers\MediaController;

Route::middleware(['middleware' => ['auth', 'role:management,webmaster']])->group(function () {
    Route::resource('media', MediaController::class)->names('media');
});
