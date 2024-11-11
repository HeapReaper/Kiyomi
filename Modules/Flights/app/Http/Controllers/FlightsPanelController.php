<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Flights\Models\Flight;
use Modules\Flights\Models\SubmittedModel;
use Modules\Flights\Enums\ModelPowerClassEnum;
use Modules\Flights\Enums\ModelTypeEnum;
use Modules\Users\Models\User;
use Storage;

class FlightsPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author AutiCodes
     * @return View
     */
    public function index()
    {
        return view('flights::pages.flight_index', [
            'flights' => Flight::orderBy('date', 'DESC')
                                ->orderBy('end_time', 'DESC')
                                ->with('user')
                                ->with('submittedModel')
                                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flights::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('flights::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('flights::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource and relationships from storage.
     *
     * @author AutiCodes
     * @return Redirect
     */
    public function destroy(int $id)
    {
        $flight = Flight::findOrFail($id)
                        ->with('submittedModel')
                        ->with('user')
                        ->first();

        $flight->user()->detach($flight->user[0]->id);

        foreach($flight->submittedModel as $model) {
            $flight->submittedModel()->detach($model->id);
        }

        $flight->delete();

        return redirect()->back()->with('success', 'Vlucht verwijderd!');
    }
}
