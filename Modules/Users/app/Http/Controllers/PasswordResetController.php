<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Modules\Users\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PasswordResetController extends Controller
{
    public function forgotPassword(Request $request): \Illuminate\Contracts\View\View
    {
        return view('users::pages.forgot-password');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Wachtwoord reset email is verstuurd!')
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(string $token): \Illuminate\Contracts\View\View
    {
        return view('users::pages.reset-password', ['token' => $token]);
    }

    public function resetPasswordPost(Request $request)
    {
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
    }
}
