<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Fetch the user's role from the database
            $userRole = auth()->user()->role;

            // Check if the user's role is 'provider' or 'admin'
            if ($userRole === 'provider' || $userRole === 'admin') {
                return $next($request);
            }
        }

        // Redirect the user to the home page if they don't have the required role
        return redirect('/');
    }
}
