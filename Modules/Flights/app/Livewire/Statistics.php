<?php

namespace Modules\Flights\Livewire;

use Livewire\Component;
use App\Helpers\Statistics as StatisticsHelper;
use App\Helpers\createChart;

class Statistics extends Component
{
	public $selectYear;

    public function mount()
    {
        $this->selectYear = now()->year;
    }

    public function updateSelectYear()
    {
        $this->selectYear = $this->selectYear;
    }
	
    public function render()
    {
		$flightsThisYearCount = createChart::createColumnChart(
			"Aantal vluchten per maand",
			StatisticsHelper::getFlightCountEachMonth($this->selectYear), // data
			false,
			false
		);
		
		$TopTenPilots = createChart::createLineChart(
			'Top 10 piloten met meeste vluchten',
			StatisticsHelper::getTopTenMostFrequentFlyers($this->selectYear),
			false,
			true
		);
		
		
		$modelFlightsCount = createChart::createColumnChart(
			"Aantal vluchten per model",
			StatisticsHelper::getModelFlightsCount($this->selectYear),
			false,
			false
		);
		
		return view('flights::livewire.statistics', [
			'flightsThisYearCount' => $flightsThisYearCount,
			'topTenPilots' => $TopTenPilots,
			'modelFlightsCount' => $modelFlightsCount
		]);
    }
}