<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Users\Models\User;

class ShowUsers extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.show-users', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%')
                                ->orWhere('mobile_phone', 'like', '%' . $this->search . '%')
                                ->get()
        ]);
    }
}
