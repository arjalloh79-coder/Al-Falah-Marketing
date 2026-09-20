<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && strtolower(Auth::user()->role ?? '') === 'admin') {
            return $next($request);
        }

        return redirect()->route('user.dashboard')->with('error', 'Unauthorized access.');
    }
}