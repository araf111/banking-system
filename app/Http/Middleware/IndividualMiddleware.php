<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndividualMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->account_type == 'Individual') {
            return $next($request);
        }
        return redirect('/'); // Redirect to home if not individual user
    }
}
