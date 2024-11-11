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

    public function import()
    {
        $flights = json_decode(file_get_contents('flights.json'));

        foreach($flights as $flight) {
            $submittedFlight = Flight::create([
                'date' => explode(' ', $flight->date_time)[0],
                'start_time' => explode(' ', $flight->date_time)[1],
                'end_time' => explode(' ', $flight->date_time)[1],
            ]);

            $user = User::where('name', $flight->member[0]->name)->first();

            $submittedFlight->user()->attach(intval($user->id));

            switch($flight->submitted_models[0]->model_type) {
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
                default:
                    $model = 1;
                    break;
            }

            switch($flight->submitted_models[0]->class) {
                case '<300W':
                    $class = 1;
                    break;
                case '300W-1200W':
                    $class = 2;
                    break;
                case '1200W-3000W':
                    $class = 3;
                default:
                    $class = 1;
                    break;
            }

            $model = SubmittedModel::create([
                'model_type' => $model,
                'class' => $class,
            ]);

            $submittedFlight->submittedModel()->attach($model->id);
        }

        return redirect('/flights-panel');
    }
}
