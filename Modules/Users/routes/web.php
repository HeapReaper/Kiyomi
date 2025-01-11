<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersContactController;
use Modules\Users\Http\Controllers\UsersController;
use Modules\Users\Http\Controllers\NewMemberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Modules\Users\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

// Resetting passwords
Route::get('/forgot-password', function () {
    return view('users::pages.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Wachtwoord reset email is verstuurd!')
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('users::pages.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('success', 'Wachtwoord reset is voltooid! Log nu in met je nieuwe wachtwoord.')
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
