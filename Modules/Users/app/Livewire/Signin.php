<?php

namespace Modules\Users\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Signin extends Component
{
	#[Validate('required|email|min:6|max:100')]
	public $email;
	
	#[Validate('required|min:4|max:100')]
	public $password;
	
	public function submit()
	{
		if (!Auth::attempt($this->only('email', 'password'))) {
			return $this->addError('credentials', 'Email of wachtwoord is niet juist.');
		}
		
		return redirect()->route('flights-panel.index');
	}
	
    public function render()
    {
        return view('users::livewire.signin');
    }
}
