<?php

use Illuminate\Support\Facades\Route;
use Modules\Articles\Http\Controllers\ArticlesController;
use Modules\Articles\Http\Controllers\CategoriesController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('articles', ArticlesController::class)->names('articles');
    Route::post('articles/upload-media', [ArticlesController::class, 'uploadMedia'])->name('articles.upload-media');
    Route::resource('categories', CategoriesController::class)->names('categories');
});

Route::group([], function () {
    Route::get('artikelen', [ArticlesController::class, 'publicIndex'])->name('articles-public.index');
    Route::get('artikelen/{slug}', [ArticlesController::class, 'publicShow'])->name('articles-public.show');
});
