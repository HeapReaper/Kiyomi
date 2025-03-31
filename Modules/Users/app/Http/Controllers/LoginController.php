<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
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
