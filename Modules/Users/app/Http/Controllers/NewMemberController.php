<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Carbon\Carbon;
use Modules\Users\Emails\SendNewMemberEmail;
use Modules\Users\Emails\SendWelcomeEmail;
use Mail;
use App\Helpers\Settings;
use App\Notifications\NewMemberNotification;
use Spatie\Permission\Models\Role;

class NewMemberController extends Controller
{
    public function index()
    {
        return view('users::index');
    }
	
    public function create()
    {
        return view('users::pages.new_member_signup');
    }
	
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'required'],
            'birthdate' => ['required', 'date_format:d-m-Y'],
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
            'anti_bot' => ['int', 'required'],
        ]);

        if ($validated['anti_bot'] != 4) {
            return redirect()->back()->with('error', 'Ik gok dat je een bot bent!');
        }

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

            $managementUsers = User::role('management')->get();

            foreach ($managementUsers as $managementUser) {
              if (empty($managementUser->email)) {
                  continue;
              }
                $managementUser->notify(new NewMemberNotification([
                    'title' => 'Nieuwe aanmelding',
                    'subtitle' => 'Van: ' . $user->name,
                    'url'   => route('users.show', $user->id)
                ]));
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Er ging iets mis! ' . $e-getMessage());
        }

        if (empty(Settings::get('email_new_members'))) {
            return redirect()->back()->with('success', 'Je formulier is verstuurd! We nemen spoedig contact op.');
        }
        
        Mail::to(Settings::get('email_new_members'))
            ->send(new SendNewMemberEmail($validated['name']));

        Mail::to($validated['email'])
            ->send(new SendWelcomeEmail($validated['name']));

        return redirect()->back()->with('success', 'Je formulier is verstuurd! We nemen spoedig contact op.');

    }
	
    public function show($id)
    {
        return view('users::show');
    }
	
    public function edit($id)
    {
        return view('users::edit');
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
