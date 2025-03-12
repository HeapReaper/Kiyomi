<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Users\Models\User;

class UsersContactController extends Controller
{
    public function index()
    {
        return view('users::pages.contact_index');
    }
	
    public function create()
    {
        return view('users::create');
    }
	
    public function store(Request $request)
    {
        // TODO: Better validation
        $validated = $request->validate([
            'send_to' => ['required'],
            'subject' => ['required'],
            'content' => ['required'],
        ]);

        $usersToSend = User::with('roles')->whereHas('roles', function ($query) use ($validated) {
            $query->whereIn('name', $validated['send_to']);
        })->get();

        // TODO, sthis is cringe..
        $usersEmails = [];
        foreach ($usersToSend as $user) {
            array_push($usersEmails, "$user->email");
        }

        try {
            Mail::html($validated['content'], function ($message) use ($validated, $usersEmails) {
                $message->bcc($usersEmails)
                    ->subject($validated['subject']);
            });
        } catch (Exception $e) {
            // Add decent error handling
            return redirect()->back()->with('error', 'Er ging iets mis! Error: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Email is verstuurd!');
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
