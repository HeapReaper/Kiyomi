<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Modules\Mail\Jobs\SendEmailToUsers;

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
        $validated = $request->validate([
            'send_to' => ['required', 'array'],
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        if (count($validated['send_to']) == 1 && $validated['send_to'][0] == 'to_yourself' ) {
            $usersToSend = User::where('id', auth()->id())->get();
        } else {
            $usersToSend = User::with('roles')->whereHas('roles', function ($query) use ($validated) {
                $query->whereIn('name', $validated['send_to']);
            })->get();
        }

        // TODO, sthis is cringe..
        // What's cringe?
        $usersEmails = [];
        foreach ($usersToSend as $user) {
            $usersEmails[] = $user->email;
        }

        try {
            SendEmailToUsers::dispatch($usersEmails, $validated['subject'], $validated['content']);
        } catch (Exception $e) {
            // Add decent error handling
            return redirect()->back()->with('error', 'Er ging iets mis! Error: '.$e->getMessage());
        }

        return redirect('/contact')->with('success', 'De emails zijn aan de queue toegevoegd, ze zullen zo verwerkt worden...');
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
