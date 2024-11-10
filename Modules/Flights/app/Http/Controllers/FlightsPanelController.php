<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Flights\Models\Flight;
use Modules\Flights\Models\SubmittedModel;
use Modules\Flights\Enums\ModelPowerClassEnum;
use Modules\Flights\Enums\ModelTypeEnum;
use Modules\Users\Models\User;

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

    public function import()
    {
        foreach(file('flightsRefactored.txt') as $line) {
            // Extract indivudial data from submission
            $exploded = explode('|', $line);

            $name = $exploded[0];
            $date = $exploded[1];
            $start_time = $exploded[2];
            $end_time = $exploded[3];
            $model = $exploded[4];
            $class = trim(preg_replace('/\s\s+/', ' ', $exploded[5]));

            // Make flight
            $flight = Flight::create([
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);

            // Get user
            $user = User::where('name', $name)->first();

            // Assign flight to user by userId
            $flight->user()->attach(intval($user->id));

            // Convert model_type and power type to integer
            switch($model) {
                case 'Vliegtuig':
                    $model = 1;
                    break;
                case 'Zweefvliegtuig':
                    $model = 2;
                    break;
                case 'Helicopter':
                    $model = 3;
                    break;
                case 'Drone':
                    $model = 4;
                    break;
            }
            switch($class) {
                case '<300W':
                    $class = 1;
                    break;
                case '300W-1200W':
                    $class = 2;
                    break;
                case '1200W-3000W':
                    $class = 3;
                    break;
            }

            // Attach model
            $model = SubmittedModel::create([
                'model_type' => $model,
                'class' => $class,
            ]);

            $flight->submittedModel()->attach($model->id);
         }

    }
}
