<?php

namespace Modules\Flights\Livewire;

use Livewire\Component;
use App\Helpers\Statistics as StatisticsHelper;
use App\Helpers\createChart;

class Statistics extends Component
{
	public $selectYear;
    public $flightsEachMonth = [];
    public $top10Pilots = [];
    public $modelsFlown = [];

    public function mount()
    {
        $this->selectYear = now()->year;
    }

    public function render()
    {
		return view('flights::livewire.statistics', [
            'flightsEachYear' => StatisticsHelper::getFlightCountEachYear(),
            'flightsThisYearCount' => StatisticsHelper::getFlightCountEachMonth(date('Y')),
            'topTenPilots' => StatisticsHelper::getTopTenMostFrequentFlyers(date('Y')),
            'modelFlightsCount' => StatisticsHelper::getModelFlightsCount(date('Y')),
        ]);
    }
}