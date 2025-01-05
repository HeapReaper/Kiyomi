<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\AuthenticationController;
use Modules\Users\Http\Controllers\UsersContactController;
use Modules\Users\Http\Controllers\UsersController;
use Modules\Users\Http\Controllers\NewMemberController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/login', function () {
	return view('users::pages.signin');
})->name('login');

Route::get('/logout', function () {
	Auth::logout();
	return redirect()->route('login');
})->name('logout');

Route::resource('member', NewMemberController::class)->names('new_member');
