<?php

use Illuminate\Support\Facades\Route;
use Modules\Tests\Http\Controllers\TestsController;

Route::group([], function () {
    Route::resource('tests', TestsController::class)->names('tests');
});
