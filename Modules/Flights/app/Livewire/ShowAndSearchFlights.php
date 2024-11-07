<?php

namespace Modules\Flights\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Flights\Models\Flight;

class ShowAndSearchFlights extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        return view('flights::livewire.show-and-search-flights', [
            'flights' => Flight::orderBy('date', 'DESC')
                        ->orderBy('end_time', 'DESC')
                        ->with('user')
                        ->with('submittedModel')
                        ->paginate(10)
        ]);
    }
}
