<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if (!Auth::user()->hasRole($roles)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
