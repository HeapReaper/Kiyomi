<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersContactController;
use Modules\Users\Http\Controllers\UsersController;
use Modules\Users\Http\Controllers\NewMemberController;
use Modules\Users\Http\Controllers\UsersStatisticsController;
use Modules\Users\Http\Controllers\PasswordResetController;
use Modules\Users\Http\Controllers\UsersExportController;
use Modules\Users\Http\Controllers\AuthenticationController;
use Modules\Users\Livewire\Signin;

Route::group(['middleware' => ['auth', 'role:management,webmaster']], function () {
    Route::resource('users', UsersController::class)->names('users');
    Route::get('users-remove/{id}', [UsersController::class, 'destroy']);
    Route::resource('contact', UsersContactController::class)->names('contact');
    Route::resource('users-statistics', UsersStatisticsController::class)->names('users-statistics');
    Route::resource('users-export', UsersExportController::class)->names('users-export');
    Route::get('users-export/download/{export}', [UsersExportController::class, 'download']);
    Route::get('users-export/destroy/{id}', [UsersExportController::class, 'destroy']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile/edit/{id}', [UsersController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update/{id}', [UsersController::class, 'update'])->name('profile.update');
});

Route::group(['middleware' => 'throttle:5,1'], function () {
    Route::get('/login', Signin::class)->name('login');
    Route::post('/login', [AuthenticationController::class, 'loginPost'])->name('loginPost');
});

Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::resource('member', NewMemberController::class)->names('new_member');

Route::group(['middleware' => 'throttle:5,1'], function () {
    Route::get('/forgot-password', [PasswordResetController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'forgotPasswordPost'])->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPasswordPost'])->middleware('guest')->name('password.update');
});
