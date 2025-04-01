<?php

use Illuminate\Support\Facades\Route;
use Modules\Articles\Http\Controllers\ArticlesController;

Route::group([], function () {
    Route::resource('articles', ArticlesController::class)->names('articles');
});
