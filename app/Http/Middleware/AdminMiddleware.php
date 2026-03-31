<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // If not logged in → go to login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // If logged in but NOT admin → go home
        if (auth()->check() && auth()->user()->is_admin != 1) {
            return redirect('/');
        }

        return $next($request);
    }
}