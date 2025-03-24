<?php

namespace Modules\Users\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Users\Models\UserExport;

class UsersExport extends Component
{
    use WithPagination;

    public string $selectYear;

    public function mount(): void
    {
        $this->selectYear = date('Y');
    }

    public function render()
    {
        return view('users::livewire.users-export', [
          'usersExport' => UserExport::query()
              ->when($this->selectYear, function ($query) {
                  $query->whereYear('created_at', $this->selectYear);
              })
              ->orderBy('created_at', 'desc')
              ->paginate(10)
        ]);
    }
}
