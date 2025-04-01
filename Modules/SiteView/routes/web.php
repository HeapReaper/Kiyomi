<?php

use Illuminate\Support\Facades\Route;
use Modules\SiteView\Http\Controllers\SiteViewController;
use Modules\SiteView\Http\Controllers\NavigationController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('siteview', SiteViewController::class)->names('siteview');
    Route::resource('navigation', NavigationController::class)->names('navigation');
});
