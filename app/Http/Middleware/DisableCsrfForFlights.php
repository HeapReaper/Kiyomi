<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class DisableCsrfForFlights extends BaseVerifier
{
    protected $except = [
        'flights/create',
    ];

    public function handle(Request $request, Closure $next)
    {
        return parent::handle($request, $next);
    }
}
