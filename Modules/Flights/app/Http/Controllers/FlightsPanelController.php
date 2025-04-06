<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Flights\Models\Flight;
use Modules\Flights\Models\SubmittedModel;
use Modules\Users\Models\User;

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

    public function edit(int $id)
    {
        if (!Auth::user()->hasRole(['management', 'webmaster'])) {
            abort(403);
        }
        return view('flights::pages.flight_edit', [
            'users' => User::orderBy('name', 'ASC')->get(),
            'flight' => Flight::with(['submittedModel', 'user'])
                            ->where('id', $id)
                            ->first(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        if (!Auth::user()->hasRole(['management', 'webmaster'])) {
            abort(403);
        }

        $validated = $request->validate([
            'user_id' => ['required'],
            'date' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'model_type' => ['required', 'max:10'],
            'power_type' => ['required', 'max:10'],
        ]);

        try {
            $flight = Flight::with(['submittedModel', 'user'])
                ->where('id', $id)
                ->first();

            $flight->date = \Carbon\Carbon::parse($validated['date'])->format('Y-m-d');
            $flight->start_time = $validated['start_time'];
            $flight->end_time = $validated['end_time'];

            $flight->user()->sync($validated['user_id']);

            $flight->submittedModel()->detach($flight->submittedModel[0]->id);

            $model = SubmittedModel::create([
                'model_type' => $validated['model_type'],
                'class' => $validated['power_type'],
            ]);

            $flight->submittedModel()->attach($model->id);
            $flight->save();
            return redirect(route('flights-panel.index'))->with('success', 'Vlucht is aangepast.');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    public function destroy(int $id)
    {
        if (!Auth::user()->hasRole(['management', 'webmaster'])) {
            abort(403);
        }

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
