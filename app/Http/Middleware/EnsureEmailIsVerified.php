<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_verified) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Please verify your email address first.');
        }

        return $next($request);
    }
}