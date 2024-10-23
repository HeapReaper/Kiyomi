<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Modules\Flights\Models\Flight;
use Modules\Flights\Models\SubmittedModel;
use Modules\Flights\Enums\ModelPowerClassEnum;
use Modules\Flights\Enums\ModelTypeEnum;

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
     * @return View
     */
    public function create()
    {
        return view('flights::pages.member_reg_new_flight', [
            'users' => User::orderBy('name', 'DESC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author AutiCodes
     * @return redirect
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'integer', 'max:25'],
            'date' => ['required', 'max:12'],
            'time' => ['required', 'max:6'],
            'model_type' => ['required'],
            'power_type_select' => ['integer'],
            'lipo_count_select' => ['integer'],
            'rechapcha_custom' => ['integer', 'required'],
        ]);

        $member = User::find($validated['name']);

        if (intval($validated['rechapcha_custom']) != 4) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $flight = Flight::create([
            'date_time' => $validated['date'] . ' ' . $validated['time'],
        ]);

        $flight->user()->attach(intval($validated['name']));

        foreach ($validated['model_type'] as $submittedModel) {
            switch ($submittedModel) {
                case ModelTypeEnum::PLANE->value:
                    $powerType = 'power_type_select_plane';
                    $lipoCount = 'lipo_count_select_plane';
                    break;
                case ModelTypeEnum::GLIDER->value:
                    $powerType = 'power_type_select_glider';
                    $lipoCount = 'lipo_count_select_glider';
                    break;
                case ModelTypeEnum::HELICOPTER->value:
                    $powerType = 'power_type_select_helicopter';
                    $lipoCount = 'lipo_count_select_helicopter';
                    break;
                case ModelTypeEnum::DRONE->value:
                    $powerType = 'power_type_select_drone';
                    $lipoCount = 'lipo_count_select_drone';
                    break;
            }

            $validated = $request->validate([
                $powerType => ['required', 'integer', 'max:24'],
                $lipoCount => ['required', 'integer', 'max:8'],
            ]);

            $model = SubmittedModel::create([
                'model_type' => $submittedModel,
                'class' => $validated[$powerType],
                'lipo_count' => $validated[$lipoCount],
            ]);

            $flight->submittedModel()->attach($model->id);
        }

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
}
