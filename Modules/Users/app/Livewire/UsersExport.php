<?php

namespace Modules\Users\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Users\Models\UserExport;

class UsersExport extends Component
{
    use WithPagination;

    public function render()
    {
        return view('users::livewire.users-export', [
          'usersExport' => UserExport::all()
        ]);
    }
}
