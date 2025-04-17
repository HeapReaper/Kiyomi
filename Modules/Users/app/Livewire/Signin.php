<?php

namespace Modules\Users\Livewire;

use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Users\Models\User;

class Signin extends Component
{
	#[Validate('required|email|min:6|max:100')]
	public $email;

	#[Validate('required|min:4|max:100')]
	public $password;

    public function submit(Request $request)
    {
        if (!Auth::attempt($this->only('email', 'password'))) {
            Log::channel('access')->warning('Failed login attempt. Email: ' . $this->email . ' IP: ' . request()->ip());
            return $this->addError('credentials', 'Email of wachtwoord is niet juist.');
        }

        $user = User::find(Auth::id());

        $rolesAllowedLogin = array_map('trim', explode(',', \App\Helpers\Settings::get('roles_allowed_sign_in')));
        $canSignIn = false;

        foreach ($user->getRoleNames() as $role) {
            if (in_array($role, $rolesAllowedLogin)) {
                $canSignIn = true;
            }
        }

        if (!$canSignIn) {
            Log::channel('access')->warning('Someone tried to sign in while that user isnt allowed to. Email: ' . $this->email . ' IP: ' . request()->ip());
            return $this->addError('credentials', 'Je mag niet inloggen!');
        }

        if ($user->two_factor_secret && $user->two_factor_confirmed) {
            Auth::logout();
            session()->put('login.id', $user->id);
            return redirect('/two-factor-challenge');
        }

        Log::channel('access')->info('Login successful. Email: ' . $this->email . ' IP: ' . request()->ip());
        return redirect()->route('flights-panel.index');
    }

    public function render()
    {
        return view('users::livewire.signin');
    }
}
