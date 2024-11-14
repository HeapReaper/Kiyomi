<?php

namespace Modules\Flights\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Flights\Models\Flight;

class ShowFlights extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $date = '';

    public function render()
    {
        return view('flights::livewire.show-flights', [
            'flights' => Flight::orderBy('date', 'DESC')
                ->orderBy('end_time', 'DESC')
                ->with('user')
                ->with('submittedModel')
                ->paginate(5),
        ]);
    }
}
