<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticationProvider;
use Modules\Users\Models\User;

class TwoFactorController extends Controller
{
    public function enable(Request $request)
    {
        $user = Auth::user();

        $user->two_factor_confirmed = true;
        $user->save();

        return redirect()->back()->with('success', '2FA is aangezet! Voeg hem nu toe aan de app...');
    }

    public function confirm(Request $request, TwoFactorAuthenticationProvider $provider)
    {
        $user = Auth::user();

        if ($provider->verify(decrypt($user->two_factor_secret), $request->code)) {
            $user->two_factor_confirmed = true;
            $user->save();

            return redirect()->back()->with('success', '2FA is aangezet!');
        }

        return redirect()->back()->with('error', '2FA is niet aangezet, verkeerde codes!');
    }

    public function showVerifyTotp(Request $request)
    {
        return view('users::pages.auth.totp');
    }

    public function verifyTotp(Request $request, TwoFactorAuthenticationProvider $provider)
    {
        $validated = $request->validate([
            'code' => ['required', 'numeric', 'digits:6'],
        ]);

        $userId = session('auth.pending_user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Geen gebruiker gevonden.');
        }

        $user = User::findOrFail($userId);

        if (!$provider->verify(decrypt($user->two_factor_secret), $request->code)) {
            return redirect()->back()->with('error', 'Verkeerde TOTP!');
        }

        session()->forget('auth.pending_user_id');
        Auth::login($user);

        return redirect('/')->with('success', 'Je bent ingelogd!!');
    }
}
