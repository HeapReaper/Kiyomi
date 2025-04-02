<?php

use Illuminate\Support\Facades\Route;
use Modules\SiteView\Http\Controllers\SiteViewController;
use Modules\SiteView\Http\Controllers\NavigationController;
use Modules\SiteView\Http\Controllers\ThemeController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('siteview', SiteViewController::class)->names('siteview');
    Route::resource('theme', ThemeController::class)->names('theme');
});
