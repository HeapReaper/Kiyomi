<?php

namespace Modules\Users\Livewire;

use Livewire\Component;
use Modules\Users\Models\User;

class Statistics extends Component
{
    public function render()
    {
		$roleCounts = [];
		$users = User::with('roles')->get();
		
		foreach ($users as $user) {
			foreach ($user->roles as $role) {
				if (!isset($roleCounts[$role->name])) {
					$roleCounts[$role->name] = 0;
				}
				$roleCounts[$role->name]++;
			}
		}
		
        return view('users::livewire.statistics', compact('roleCounts'));
    }
}
