<?php


namespace App\Helpers;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class createChart
{
	static function createColumnChart(string $name, array $data, bool $legend, bool $dataLabels): ColumnChartModel
	{
		$colors = array('#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#A1FF33', '#5733FF', '#FF8C00', '#8CFF00', '#00FF8C', '#8C00FF', '#FF0033', '#0033FF');
		
		$chart = (new ColumnChartModel());
		$chart->setTitle($name);
		$chart->setLegendVisibility($legend);
		$chart->setDataLabelsEnabled($dataLabels);
		
		$colorCounter = 0;
		foreach ($data as $key => $value) {
			$chart->addColumn($key, $value, $colors[$colorCounter % count($colors)]);
			$colorCounter++;
		}
		
		return $chart;
	}
	
	static function createLineChart(string $name, array $data, bool $legend, bool $dataLabels): lineChartModel
	{
		$colors = array('#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#A1FF33', '#5733FF', '#FF8C00', '#8CFF00', '#00FF8C', '#8C00FF', '#FF0033', '#0033FF');
		
		$lineChart = (new lineChartModel());
		$lineChart->setTitle($name);
		$lineChart->setSmoothCurve();
		$lineChart->setLegendVisibility($legend);
		$lineChart->setDataLabelsEnabled($dataLabels);
		
		$colorCounter = 0;
		foreach ($data as $key => $value) {
			$lineChart->addPoint($key, $value, $colors[$colorCounter % count($colors)]);
			$colorCounter++;
		}
		
		return $lineChart;
	}
	
	static function createPieChart(string $name, array $data, bool $legend, bool $dataLabels): PieChartModel
	{
		$colors = array('#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#A1FF33', '#5733FF', '#FF8C00', '#8CFF00', '#00FF8C', '#8C00FF', '#FF0033', '#0033FF');

		$pieChart = (new PieChartModel());
		$pieChart->setTitle($name);
		$pieChart->setLegendVisibility($legend);
		$pieChart->setDataLabelsEnabled($dataLabels);
		
		$colorCounter = 0;
		foreach ($data as $key => $value) {
			$pieChart->addSlice($key, $value, $colors[$colorCounter % count($colors)]);
			$colorCounter++;
		}
		
		return $pieChart;
	}
}
