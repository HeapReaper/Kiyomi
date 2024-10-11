<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Users\Models\User;

class ShowUsers extends Component
{
    public $search = '';
    public $role = '';

    public function render()
    {
        return view('livewire.show-users', [
            'users' => User::query()
                            ->when($this->role && $this->role == 'all', function ($query) {
                                $query->with('roles');
                            })
                            ->when($this->role && $this->role != 'all', function ($query) {
                                $query->role($this->role);
                            })
                            ->where(function ($query) {
                                $query->where('name', 'like', '%' . $this->search . '%')
                                        ->orWhere('email', 'like', '%' . $this->search . '%')
                                        ->orWhere('mobile_phone', 'like', '%' . $this->search . '%');
                            })
                            ->get()
        ]);
    }

}
