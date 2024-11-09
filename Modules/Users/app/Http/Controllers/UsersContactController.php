<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Events\UsersContactWasSubmitted;
use Mail;
use Modules\Users\Models\User;

class UsersContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author AutiCodes
     * @return View
     */
    public function index()
    {
        return view('users::pages.contact_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage and sends email
     *
     * @author AutiCodes
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // TODO: Better validation
        $validated = $request->validate([
            'send_to' => ['required'],
            'subject' => ['required'],
            'content' => ['required'],
        ]);

        $usersToSend = User::with('roles')->whereHas('roles', function($query) use ($validated) {
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
            return redirect()->back()->with('error', 'Er ging iets mis! Error: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Email is verstuurd!');
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
