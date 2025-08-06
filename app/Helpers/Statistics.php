<?php

namespace App\Helpers;

use Modules\Flights\Models\Flight;
use Illuminate\Support\Facades\DB;
use App\Helpers\createChart;
use Modules\Flights\Enums\ModelName;
use Modules\Users\Models\User;

class Statistics
{

    static function getFlightCountEachYear()
    {
        $results = DB::table('flights')
            ->select(DB::raw('YEAR(date) AS year, COUNT(*) AS flight_count'))
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy(DB::raw('YEAR(date)'))
            ->get();

        $years = [];
        foreach ($results as $result) {
            $years[$result->year] = $result->flight_count;
        }

        return $years;
    }

	static function getFlightCountEachMonth(int $year)
	{
		$results = DB::table('flights')
			->select(DB::raw('MONTH(date) AS month, COUNT(*) AS flight_count'))
			->whereYear('date', $year)
			->groupBy(DB::raw('MONTH(date)'))
			->orderBy(DB::raw('MONTH(date)'))
			->get();
		
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
	
	static function getYearsFlown(): array
	{
		$result = DB::table('flights')
			->select(DB::raw('YEAR(date) as year'))
			->groupBy('year')
			->orderByDesc('year')
			->get();
		
		$years = [];
		foreach ($result as $year) {
			$years[] = $year->year;
		}
		
		return array_reverse($years);
	}
	
	static function getTotalFlightsCount(int $year): int
	{
		return Flight::whereBetween('date', [$year . '-01-01', $year . '-12-31'])->count();
	}
	
	static function getTotalMembersCount(): int
	{
		return User::all()->count();
	}
}
