<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Users\Models\User;

class AuthenticationController extends Controller
{
    public function index(Request $requests)
    {
        return view('users::pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            Log::channel('access')->warning('Failed login attempt. Email: ' . $request->email . ' IP: ' . $request->ip());
            return redirect()->back()->with('error', 'Login gegevens incorrect.');
        }

        $user = Auth::user();

        $rolesAllowedLogin = array_map('trim', explode(',', \App\Helpers\Settings::get('roles_allowed_sign_in')));
        $canSignIn = false;

        foreach ($user->getRoleNames() as $role) {
            if (in_array($role, $rolesAllowedLogin)) {
                $canSignIn = true;
                break;
            }
        }

        if (!$canSignIn) {
            Log::channel('access')->warning('User not allowed to sign in. Email: ' . $request->email . ' IP: ' . $request->ip());
            Auth::logout();
            return redirect()->back()->with('error', 'Je mag niet inloggen!.');
        }

        $request->session()->regenerate();

        Log::channel('access')->info('Login successful. Email: ' . $request->email . ' IP: ' . $request->ip());

        return redirect()->route('flights-panel.index');
    }
}
