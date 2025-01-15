<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Providers;
use Auth;

class authCheckController extends Controller
{
    //

    public function index(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, retrieve the logged-in user's details
            $user = Auth::user();

            // Fetch user details from the database
            $userData = user::with('providers')->find($user->id);

            // Return the user's details as JSON response
            return response()->json([
                'authenticated' => true,
                'user' => $userData
            ], 200);
        } else {
            // User is not authenticated
            return response()->json([
                'authenticated' => false,
                'user' => null
            ], 401);
        }
    }

    public function checkAdmin()
    {
        // Check if the authenticated user is an admin
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';
        
        return response()->json(['isAdmin' => $isAdmin]);
    }
    
    public function checkProvider()
    {
        // Check if the authenticated user is a provider
        $isProvider = auth()->check() && auth()->user()->role === 'provider';
        
        return response()->json(['isProvider' => $isProvider]);
    }
}
