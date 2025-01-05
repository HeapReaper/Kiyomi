<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightsStatisticsController extends Controller
{
    public function index()
    {
        return view('flights::index');
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
