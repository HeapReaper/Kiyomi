<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Auth;
use Session;
use Redirect;

class AuthenticationController extends Controller
{
    /**
     * Shows the login page
     *
     * @author AutiCodes
     * @return View
     */
    public function index()
    {
        return view('auth.pages.login');
    }

    /**
     * Signs in the user
     *
     * @author AutiCodes
     * @param Request $request
     */
    public function signIn(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($validated)) {
            return redirect()
                        ->back()
                        ->with('error', 'Login incorrect!')
                        ->withInput();
        }

        return redirect()->route('panel.index');
    }
}
