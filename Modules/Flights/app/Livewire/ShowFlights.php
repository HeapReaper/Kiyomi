<?php

namespace Modules\Flights\Livewire;

use Livewire\Component;
use Modules\Flights\Models\Flight;
use Livewire\WithPagination;

class ShowFlights extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $date = '';

    public function render()
    {
        return view('livewire.show-flights', [
            'flights' => Flight::orderBy('date', 'DESC')
                                ->orderBy('end_time', 'DESC')
                                ->with('user')
                                ->with('submittedModel')
                                ->paginate(5)
        ]);
    }
}
