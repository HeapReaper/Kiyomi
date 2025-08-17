<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (TokenMismatchException $e, $request) {
            $sessionToken = $request->session()->token();
            $submittedToken = $request->input('_token')
                ?? $request->header('X-CSRF-TOKEN')
                ?? $request->cookie('XSRF-TOKEN');

            Log::warning('CSRF token mismatch detected.', [
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
                'user_id' => optional(auth()->user())->id,
                'session_token' => $sessionToken,
                'submitted_token' => $submittedToken,
                'input_keys' => array_keys($request->except(['_token','password','password_confirmation'])),
            ]);

            // Optional: show a friendly message instead of default 419 page
            return response()->view('errors.csrf', [], 419);
        });
    }

}
