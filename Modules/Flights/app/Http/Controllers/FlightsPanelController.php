<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Flights\Models\Flight;
use Storage;

class FlightsPanelController extends Controller
{
    public function index()
    {
        return view('flights::pages.flight_index');
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
        return view('flights::pages.flight_edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(int $id)
    {
		$flight = Flight::with(['submittedModel', 'user'])->where('id', $id)->first();

	    if (!$flight) {
	        return redirect()->back()->with('error', 'Vlucht niet gevonden!');
	    }

        $flight->user()->detach($flight->user[0]->id);

        foreach ($flight->submittedModel as $model) {
            $flight->submittedModel()->detach($model->id);
        }

        $flight->delete();

        return redirect()->back()->with('success', 'Vlucht verwijderd!');
    }
}
