<?php

use Illuminate\Support\Facades\Route;
use Modules\SiteView\Http\Controllers\SiteViewController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('siteview', SiteViewController::class)->names('siteview');
});
