<?php

use Illuminate\Support\Facades\Route;
use Modules\SiteView\Http\Controllers\SiteViewController;

Route::group([], function () {
    Route::resource('siteview', SiteViewController::class)->names('siteview');
});
