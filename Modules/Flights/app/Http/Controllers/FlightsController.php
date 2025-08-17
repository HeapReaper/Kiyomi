<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Flights\Models\Flight;
use Modules\Flights\Models\SubmittedModel;
use Modules\Users\Models\User;

class FlightsController extends Controller
{
    public function index()
    {
        return response()
            ->view('flights::pages.member_reg_new_flight')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
    }

    public function create()
    {
        return view('flights::pages.member_reg_new_flight', [
            'users' => User::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Log::debug('Store started');

        $validated = $request->validate([
            'name' => ['required', 'string'],
            'date' => ['required', 'max:12'],
            'start_time' => ['required', 'max:6'],
            'end_time' => ['required', 'max:6'],
            'model_type' => ['required', 'integer', 'max:5'],
            'power_type' => ['required', 'integer', 'max:4'],
            'rechapcha_custom' => ['integer', 'required'],
        ]);

        Log::debug('Validation passed', ['validated' => $validated]);

        if (intval($validated['rechapcha_custom']) != 4) {
            Log::channel('user_error')->info('Vlucht aanmelden - Verkeerde Recaptha', [
                'name' => $validated['name'],
                'code' => $validated['rechapcha_custom']
            ]);
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $user = User::whereRaw("SOUNDEX(name) = SOUNDEX(?)", [$validated['name']])->first();

        if (!$user) {
            Log::channel('user_error')->info('Vlucht aanmelden - Naam niet gevonden', ['name' => $validated['name']]);
            return redirect()->back()->with('error', 'Ik kon je naam niet vinden, heb je hem goed getypt?')->withInput();
        }

        Log::debug('User found', ['user_id' => $user->id]);

        try {
            $flight = Flight::create([
                'date' => $validated['date'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);

            Log::debug('Flight created', ['flight_id' => $flight->id]);

            $flight->user()->attach($user->id);
            Log::debug('User attached to flight', ['flight_id' => $flight->id, 'user_id' => $user->id]);

            $model = SubmittedModel::create([
                'model_type' => $validated['model_type'],
                'class' => $validated['power_type'],
            ]);

            Log::debug('SubmittedModel created', ['model_id' => $model->id]);

            $flight->submittedModel()->attach($model->id);
            Log::debug('Model attached to flight', ['flight_id' => $flight->id, 'model_id' => $model->id]);

//      Cache::tags(['flights_search'])->flush();

            Log::debug('Store completed successfully');
            return redirect()->back()->with('success', 'Vlucht is aangemeld!');
        } catch (\Throwable $e) {
            Log::error('Flight store failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Er ging iets mis!')->withInput();
        }
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

    public function redirect()
    {
        return redirect('/flights/create');
    }
}
