<?php

use Illuminate\Support\Facades\Route;
use Modules\Articles\Http\Controllers\ArticlesController;
use Modules\Articles\Http\Controllers\CategoriesController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('articles', ArticlesController::class)->names('articles');
    Route::resource('categories', CategoriesController::class)->names('categories');
});
