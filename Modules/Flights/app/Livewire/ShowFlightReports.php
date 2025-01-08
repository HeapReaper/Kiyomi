<?php

namespace Modules\Flights\Livewire;

use Livewire\Component;
use Modules\Flights\Models\FlightReport;

class ShowFlightReports extends Component
{
    public function render()
    {
        return view('flights::livewire.show-flight-reports', [
			'flightReports' => FlightReport::orderBy('date', 'DESC')->get(),
		]);
    }
}
