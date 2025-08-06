<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\Http\Controllers\HomeController;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::middleware(CacheResponse::class)->group(function () {
    Route::resource('/', HomeController::class)->names('home');
});
