<?php

namespace Modules\Users\Livewire;

use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    Log::channel('access')->info('Login successful. Email: ' . $this->email . ' IP: ' . request()->ip());
		return redirect()->route('flights-panel.index');
	}
	
    public function render()
    {
        return view('users::livewire.signin');
    }
}
