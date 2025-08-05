<?php

namespace Modules\Users\Livewire;

use Livewire\Component;
use Modules\Users\Models\User;
use Livewire\WithPagination;

class ShowAndSearchUsers extends Component
{
	use WithPagination;
	
    public $search = '';

    public $role = '';

    public $instructor = '';

    public function render()
    {
        return view('users::livewire.show-and-search-users', [
            'users' => User::query()
                ->when($this->role && $this->role == 'all', function ($query) {
                    $query->with('roles');
                })
                ->when($this->role && $this->role != 'all', function ($query) {
                    $query->role($this->role);
                })
                ->when($this->instructor === 'yes', function ($query) {
                    $query->whereHas('instructor', function ($q) {
                        $q->whereIn('model_type', [1, 2, 3]);
                    });
                })
                ->where(function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('mobile_phone', 'like', '%'.$this->search.'%')
                        ->orWhere('knvvl', 'like', '%'.$this->search.'%')
                        ->orWhere('rdw_number', 'like', '%'.$this->search.'%');
                })
                ->orderBy('name', 'ASC')
                ->paginate(20),
        ]);
    }
}
