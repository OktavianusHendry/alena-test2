<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateMentor
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('mentor')->check()) {
            return redirect()->route('login')->withErrors('Unauthorized access');
        }

        return $next($request);
    }
}
