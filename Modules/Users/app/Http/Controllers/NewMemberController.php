<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Carbon\Carbon;

class NewMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users::pages.new_member_signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'required'], // TODO add unique check name
            'birthdate' => ['string', 'required'],
            'address' => ['string', 'required'],
            'postcode' => ['string', 'required'],
            'city' => ['string', 'required'],
            'phone' => ['string', 'required'],
            'email' => ['email', 'required'],
            'rdw_number' => ['string', 'nullable'],
            'knvvl' => ['string', 'nullable'],
            'droneA1Checkbox' => ['int', 'nullable'],
            'droneA2Checkbox' => ['int', 'nullable'],
            'droneA3Checkbox' => ['int', 'nullable'],
            'PlaneCertCheckbox' => ['int', 'nullable'],
            'HeliCertCheckbox' => ['int', 'nullable'],
            'gliderCertCheckbox' => ['int', 'nullable'],
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'birthdate' => Carbon::parse($validated['birthdate'])->format('Y-m-d'),
                'address' => $validated['address'],
                'zip_code' => $validated['postcode'],
                'city' => $validated['city'],
                'mobile_phone' => $validated['phone'],
                'rdw_number' => $validated['rdw_number'],
                'knvvl' => $validated['knvvl'],
                'email' => $validated['email'],
                'instruct' => 0,
                'has_plane_brevet' => $validated['PlaneCertCheckbox'] ?? 0,
                'has_helicopter_brevet' => $validated['HeliCertCheckbox'] ?? 0,
                'has_glider_brevet' => $validated['gliderCertCheckbox'] ?? 0,
                'in_memoriam' => 0,
                'has_drone_a1' => $validated['droneA1Checkbox'] ?? 0,
                'has_drone_a2' => $validated['droneA2Checkbox'] ?? 0,
                'has_drone_a3' => $validated['droneA3Checkbox'] ?? 0,
            ]);

            $user->assignRole(6);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Er ging iets mis! '); 
        }

        return redirect()->back()->with('success', 'Je formulier is verstuurd! We nemen spoedig contact op.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('users::edit');
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
