<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        // Check if user role is 'student' or 'user'
        if (Auth::user()->role !== 'student' && Auth::user()->role !== 'user') {
            return redirect('/login')->with('error', 'Access denied. Students only.');
        }

        return $next($request);
    }
}
