<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersController;
use Modules\Users\Http\Controllers\UsersContactController;
use Modules\Users\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UsersController::class)->names('users');
    Route::get('users-remove/{id}', [UsersController::class, 'destroy']);
    Route::resource('contact', UsersContactController::class)->names('contact');
});

Route::group([], function () {
    Route::get('login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('login-post', [AuthenticationController::class, 'signIn'])->name('login-post');
    Route::get('logout', [AuthenticationController::class, 'signOut']);
});
