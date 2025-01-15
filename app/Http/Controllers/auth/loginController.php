<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user;
use Auth;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            
            // Get the user's role
            $role = $user->role; // Assuming 'role' is the column name in your users table that stores the user's role
            
            // Optionally, you can perform additional checks here before logging in the user
            Auth::login($user);
    
            return response()->json(['message' => 'Login successful', 'user' => $user, 'role' => $role], 200);
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    
    // Logout method
    public function logout(Request $request)
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->invalidate();
        return response()->json(['message' => 'Logout successful'], 200);
    }

}