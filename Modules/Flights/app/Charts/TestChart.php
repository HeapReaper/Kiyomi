<?php

namespace Modules\Flights\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class TestChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->labels(['January', 'February', 'March', 'April', 'May']);
        $this->dataset('Test', 'line', [10, 20, 30, 40, 50])
             ->color('#FFFFFF')
             ->backgroundColor('#ffaaaa');
		
        $this->options([
            'scales' => [
                'x' => [
                    'ticks' => [
                        'color' => '#FFFFFF'
                    ]
                ],
                'y' => [
                    'ticks' => [
                        'color' => '#FFFFFF'
                    ]
                ]
            ]
		]);
    }
}