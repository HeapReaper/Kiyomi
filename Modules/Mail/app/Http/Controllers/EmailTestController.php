<?php

namespace Modules\Mail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailTestController extends Controller
{
    public function sendTestMail(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'email_test' => ['required', 'email'],
        ]);

        try {
            Mail::raw('This is a test email from Kiyomi.', function ($message) use ($validated, $request) {
                $message->to($validated['email_test'])
                    ->subject('Kiyomi test email');
            });
            return redirect()->back()->with('success', 'Test email is verstuurd, hij zal zo in je inbox of SPAM zitten...');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ik kon geen test email versturen: ' . $e->getMessage());
        }
    }
}
