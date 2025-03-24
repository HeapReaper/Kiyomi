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
            'roles' => ['required', 'array', 'min:1'],
        ]);

        Settings::insertOrUpdate('email_new_members', $validated['email_new_members'] ?? 0);
        Settings::insertOrUpdate('roles_allowed_sign_in', implode(',', $validated['roles'] ?? []));

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
