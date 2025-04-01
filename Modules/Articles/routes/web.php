<?php

use Illuminate\Support\Facades\Route;
use Modules\Articles\Http\Controllers\ArticlesController;

Route::group(['middleware' => ['auth', 'roles:management:webmaster']], function () {
    Route::resource('articles', ArticlesController::class)->names('articles');
});
