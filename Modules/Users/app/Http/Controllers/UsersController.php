<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Modules\Users\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('users::pages.index');
    }
	
    public function create()
    {
        return view('users::pages.create');
    }
	
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'birthdate' => ['required', 'date'],
            'address' => ['required', 'string', 'max:100'],
            'postcode' => ['required', 'max:10'],
            'city' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'max:16'],
            'rdw_number' => ['nullable'],
            'knvvl' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'roles' => ['required'],
            'instruct' => ['required', 'integer', 'max:1'],
            'PlaneCertCheckbox' => ['nullable'],
            'HeliCertCheckbox' => ['nullable'],
            'gliderCertCheckbox' => ['nullable'],
            'honoraryMemberCheckbox' => ['nullable'],
            'droneA1Checkbox' => ['nullable'],
            'droneA2Checkbox' => ['nullable'],
            'droneA3Checkbox' => ['nullable'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'birthdate' => Carbon::parse($validated['birthdate'])->format('Y-m-d'),
            'address' => $validated['address'],
            'zip_code' => $validated['postcode'],
            'city' => $validated['city'],
            'mobile_phone' => $validated['phone'],
            'rdw_number' => $validated['rdw_number'] ?? null,
            'knvvl' => $validated['knvvl'] ?? 0,
            'email' => $validated['email'],
            'instruct' => $validated['instruct'],
            'has_plane_brevet' => $validated['PlaneCertCheckbox'] ?? 0,
            'has_helicopter_brevet' => $validated['HeliCertCheckbox'] ?? 0,
            'has_glider_brevet' => $validated['gliderCertCheckbox'] ?? 0,
            'in_memoriam' => $validated['honoraryMemberCheckbox'] ?? 0,
            'has_drone_a1' => $validated['droneA1Checkbox'] ?? 0,
            'has_drone_a2' => $validated['droneA2Checkbox'] ?? 0,
            'has_drone_a3' => $validated['droneA3Checkbox'] ?? 0,
        ]);

        $user->syncRoles($validated['roles']);

        return redirect(route('users.index'))->with('success', 'Lid is aangemaakt!');
    }
	
    public function show($id)
    {
        return view('users::pages.show', [
            'user' => User::find($id),
        ]);
    }
	
    public function edit($id)
    {
        return view('users::pages.edit', [
            'user' => User::find($id),
        ]);
    }
	
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'birthdate' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:100'],
            'postcode' => ['nullable', 'string', 'max:10'],
            'city' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:15'],
            'rdw_number' => ['nullable'],
            'knvvl' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string'],
            'instruct' => ['required', 'integer', 'max:1'],
            'PlaneCertCheckbox' => ['nullable'],
            'HeliCertCheckbox' => ['nullable'],
            'gliderCertCheckbox' => ['nullable'],
            'honoraryMemberCheckbox' => ['nullable'] ?? 0,
            'droneA1Checkbox' => ['nullable'],
            'droneA2Checkbox' => ['nullable'],
            'droneA3Checkbox' => ['nullable'],
            'password' => ['nullable'],
        ]);

        $userOldData = User::find($id);

        $user = User::find($id)->update([
            'name' => $validated['name'],
            'birthdate' => Carbon::parse($validated['birthdate'])->format('Y-m-d'),
            'address' => $validated['address'],
            'zip_code' => $validated['postcode'],
            'city' => $validated['city'],
            'mobile_phone' => $validated['phone'],
            'rdw_number' => $validated['rdw_number'],
            'knvvl' => $validated['knvvl'],
            'email' => $validated['email'],
            'instruct' => $validated['instruct'],
            'has_plane_brevet' => $validated['PlaneCertCheckbox'] ?? 0,
            'has_helicopter_brevet' => $validated['HeliCertCheckbox'] ?? 0,
            'has_glider_brevet' => $validated['gliderCertCheckbox'] ?? 0,
            'in_memoriam' => $validated['honoraryMemberCheckbox'] ?? 0,
            'has_drone_a1' => $validated['droneA1Checkbox'] ?? 0,
            'has_drone_a2' => $validated['droneA2Checkbox'] ?? 0,
            'has_drone_a3' => $validated['droneA3Checkbox'] ?? 0,
        ]);

        // TODO: fix role validation
        if (array_key_exists('password', $validated)) {
            User::find($id)->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        // TODO: Change to $user
        User::find($id)->syncRoles([$validated['role']]);

        return redirect(route('users.index'))->with('success', 'Gebruiker is geupdated!');
    }
	
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect(route('users.index'))->with('success', 'Lid verwijderd!');
    }
}
