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
}
