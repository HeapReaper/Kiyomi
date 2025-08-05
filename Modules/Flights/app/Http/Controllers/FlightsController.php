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
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'date' => ['required', 'max:12'],
            'start_time' => ['required', 'max:6'],
            'end_time' => ['required', 'max:6'],
            'model_type' => ['required', 'integer', 'max:5'],
            'power_type' => ['required', 'integer', 'max:4'],
            'rechapcha_custom' => ['integer', 'required'],
        ]);

        if (intval($validated['rechapcha_custom']) != 4) {
            Log::channel('user_error')->info('Vlucht aanmelden - Verkeerde Recaptha - Naam: ' . $validated['name'] . ' - Code: ' . $validated['rechapcha_custom']);
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $user = User::whereRaw("SOUNDEX(name) = SOUNDEX(?)", [$validated['name']])->first();
        
        if (!$user) {
            Log::channel('user_error')->info('Vlucht aanmelden - Naam niet gevonden - ' . $validated['name']);
            return redirect()->back()->with('error', 'Ik kon je naam niet vinden, heb je hem goed getypt?')->withInput();
        }

        $flight = Flight::create([
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        $flight->user()->attach($user->id);

        $model = SubmittedModel::create([
            'model_type' => $validated['model_type'],
            'class' => $validated['power_type'],
        ]);

        $flight->submittedModel()->attach($model->id);

//    	Cache::tags(['flights_search'])->flush();

        return redirect()->back()->with('success', 'Vlucht is aangemeld!');
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
