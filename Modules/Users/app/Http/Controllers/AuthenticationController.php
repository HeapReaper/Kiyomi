<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Models\User;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('users::pages.auth.login');
    }

    public function loginPost(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withInput()->with('error', 'Verkeerde login!');
        }

        if ($user->hasTotpEnabled()) {
            session(['auth.pending_user_id' => $user->id]);
            return redirect('/2fa/verify');
        }

        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return back()->withInput()->with('error', 'Verkeerde login!');
        }

        return redirect('/')->with('success', 'Je bent ingelogd!!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Je bent uitgelogd!!');
    }
}
