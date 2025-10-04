<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersContactController;
use Modules\Users\Http\Controllers\UsersController;
use Modules\Users\Http\Controllers\NewMemberController;
use Modules\Users\Http\Controllers\UsersStatisticsController;
use Modules\Users\Http\Controllers\PasswordResetController;
use Modules\Users\Http\Controllers\UsersExportController;
use Illuminate\Support\Facades\Auth;
use Spatie\ResponseCache\Middlewares\CacheResponse;
use Modules\Users\Http\Controllers\AuthenticationController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UsersController::class)->names('users');
    Route::get('users-remove/{id}', [UsersController::class, 'destroy']);
    Route::resource('contact', UsersContactController::class)->names('contact');
    Route::resource('users-statistics', UsersStatisticsController::class)->names('users-statistics');
    Route::resource('users-export', UsersExportController::class)->names('users-export');
    Route::get('users-export/download/{export}', [UsersExportController::class, 'download']);
    Route::get('users-export/destroy/{id}', [UsersExportController::class, 'destroy']);
});

Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
Route::post('/login-post', [AuthenticationController::class, 'login']);

Route::get('/logout', function () {
	Auth::logout();
	return redirect()->route('login');
})->name('logout');

Route::middleware([])->group(function () { //CacheResponse::class
    Route::resource('member', NewMemberController::class)->names('new_member');

    Route::get('/forgot-password', [PasswordResetController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'forgotPasswordPost'])->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPasswordPost'])->middleware('guest')->name('password.update');
});