<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Flights\Charts\TestChart;

class FlightsStatisticsController extends Controller
{
    public function index()
    {
		$chart = new TestChart();
		return view('flights::pages.statistics', compact('chart'));
    }

    public function create()
    {
        return view('flights::create');
    }

    public function store(Request $request)
    {
        //
    }
	
    public function show($id)
    {
        return view('flights::show');
    }
	
    public function edit($id)
    {
        return view('flights::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }
	
    public function destroy($id)
    {
        //
    }
}
