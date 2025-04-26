<?php

use Illuminate\Support\Facades\Route;
use Modules\Memberships\Http\Controllers\MembershipsController;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('memberships', MembershipsController::class)->names('memberships');
});
