<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Settings;
use Modules\Settings\Models\Setting;
use Modules\Users\Models\Role;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings::index', [
            'settings' => Setting::all(),
			'roles' => Role::all(),
        ]);
    }
	
    public function create()
    {
        return view('settings::create');
    }
	
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email_new_members' => ['email', 'nullable'],
			'role_management_allowed_sign_in' => ['int', 'nullable'],
			'role_junior_member_allowed_sign_in' => ['int', 'nullable'],
			'role_aspirant_member_allowed_sign_in' => ['int', 'nullable'],
			'role_member_allowed_sign_in' => ['int', 'nullable'],
			'role_donor_allowed_sign_in' => ['int', 'nullable'],
			'role_not_paid_allowed_sign_in' => ['int', 'nullable'],

        ]);

        Settings::insertOrUpdate('email_new_members', $validated['email_new_members'] ?? 0);
        Settings::insertOrUpdate('role_management_allowed_sign_in', $validated['role_management_allowed_sign_in'] ?? 0);
        Settings::insertOrUpdate('role_junior_member_allowed_sign_in', $validated['role_junior_member_allowed_sign_in'] ?? 0);
        Settings::insertOrUpdate('role_aspirant_member_allowed_sign_in', $validated['role_aspirant_member_allowed_sign_in'] ?? 0);
        Settings::insertOrUpdate('role_member_allowed_sign_in', $validated['role_member_allowed_sign_in'] ?? 0);
        Settings::insertOrUpdate('role_donor_allowed_sign_in', $validated['role_donor_allowed_sign_in'] ?? 0);
        Settings::insertOrUpdate('role_not_paid_allowed_sign_in', $validated['role_not_paid_allowed_sign_in'] ?? 0);

        return redirect()->back()->with('success', 'Instellingen opgeslagen!');
    }

    public function show($id)
    {
        return view('settings::show');
    }
	
    public function edit($id)
    {
        return view('settings::edit');
    }
	
    public function update(Request $request, $id)
    {
        //
    }
	
    public function destroy($id)
    {
        //
    }
}
