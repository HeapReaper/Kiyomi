<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Flights\Models\Flight;
use Modules\Flights\Models\SubmittedModel;
use Modules\Users\Models\User;

class FlightsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('flights::pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @author AutiCodes
     *
     * @return View
     */
    public function create()
    {
        return view('flights::pages.member_reg_new_flight', [
            'users' => User::orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author AutiCodes
     *
     * @return redirect
     */
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('name', 'like', '%' . $validated['name'] . '%')->first();

        if (!$user) {
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

        return redirect()->back()->with('success', 'Vlucht is aangemeld!');
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Temp redirect
     */
    public function redirect()
    {
        return redirect('/flights/create');
    }
}
