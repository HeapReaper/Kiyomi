<?php

namespace Modules\Mail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Mail\Jobs\SendTestMailJob;

class EmailTestController extends Controller
{
    public function sendTestMail(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'email_test' => ['required', 'email'],
        ]);

        try {
            SendTestMailJob::dispatch($validated['email_test']);

            return redirect()->back()->with('success', 'Je test email is aan de queue toegevoegd, hij zal zo verwerkt worden...');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ik kon geen test email versturen: ' . $e->getMessage());
        }
    }
}
