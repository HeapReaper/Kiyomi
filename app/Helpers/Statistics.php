<?php

namespace App\Helpers;

use Modules\Flights\Models\Flight;
use Illuminate\Support\Facades\DB;
use App\Helpers\createChart;
use Modules\Flights\Enums\ModelName;

class Statistics
{
	static function getFlightCountEachMonth(int $year)
	{
		$results = DB::select("
			SELECT MONTH(date) AS month, COUNT(*) AS flight_count
		   	FROM flights
		   	WHERE YEAR(date) = ?
		   	GROUP BY MONTH(date)
			ORDER BY month",
			[$year]
		);
		
		$monthNames = [
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maart',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Augustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'December',
		];

		$monthsWithNumbers = [
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 0,
			6 => 0,
			7 => 0,
			8 => 0,
			9 => 0,
			10 => 0,
			11 => 0,
			12 => 0,
		];
		
		foreach ($results as $result) {
			if (!array_key_exists($result->month, $monthsWithNumbers)) {
				continue;
			}
			$monthsWithNumbers[$result->month] = $result->flight_count;
		}
		
		$monthsWithNames = [];
		foreach ($monthsWithNumbers as $month => $count) {
			$monthsWithNames[$monthNames[$month]] = $count;
		}
		
		return $monthsWithNames;
	}
	
	static function getTopTenMostFrequentFlyers(int $year): array
	{
		$result = DB::table('flight_user')
			->select('users.id', 'users.name', DB::raw('COUNT(flight_user.flight_id) as flight_count'))
			->join('users', 'flight_user.user_id', '=', 'users.id')
			->join('flights', 'flight_user.flight_id', '=', 'flights.id')
			->whereYear('flights.date', $year)
			->groupBy('users.id', 'users.name')
			->orderByDesc('flight_count')
			->limit(10)
			->get()
			->toArray();
		
		$topTen = [];
		
		foreach ($result as $user) {
			$topTen[$user->name] = $user->flight_count;
		}
		
		return $topTen;
	}
	
	static function getModelFlightsCount(int $year): array
	{
		$result = DB::table('flight_submitted_model')
			->select('model_type', DB::raw('count(*) as total_flights'))
			->whereYear('created_at', $year)
			->groupBy('model_type')
			->get();
			
		$modelFlights = [];
		
		foreach ($result as $flight) {
			$modelFlights[ModelName::convertToName($flight->model_type)] = $flight->total_flights;
		}
		
		return $modelFlights;
	}
}
