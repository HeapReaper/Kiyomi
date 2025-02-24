<?php

namespace Modules\Flights\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Flights\Models\Flight;
use Illuminate\Support\Facades\Cache;

class ShowAndSearchFlights extends Component
{
    use WithPagination;

    public string $search = '';
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
        $flights = Flight::with('user', 'submittedModel')
                    ->whereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->whereYear('date', $this->selectYear)
                    ->orderBy('date', 'DESC')
                    ->orderBy('end_time', 'DESC')
                    ->paginate(20);

        return view('flights::livewire.show-and-search-flights', [
            'flights' => $flights,
        ]);
    }
}
