<?php

namespace Modules\Flights\Livewire;

use Livewire\Component;
use Modules\Flights\Models\FlightReport;
use Livewire\WithPagination;

class ShowFlightReports extends Component
{
    use WithPagination;

    public string $selectYear = '';

    public function mount(): void
    {
        $this->selectYear = date('Y');
    }

    public function updateSelectYear(): void
    {
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $flightReports = FlightReport::whereYear('date', $this->selectYear)
            ->orderBy('date', 'desc')
            ->paginate(1);

        return view('flights::livewire.show-flight-reports', [
			'flightReports' => $flightReports,
		]);
    }
}
