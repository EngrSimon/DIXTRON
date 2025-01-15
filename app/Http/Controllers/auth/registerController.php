<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Providers;
use App\Models\user;
use Str;
use Auth;


class registerController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'surname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email|unique:users',
                'mobile' => 'required',
                'state' => 'required',
                'country' => 'required',
                'name' => 'required|unique:users',
                'password' => 'required|max:8',
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're storing images
            ]);
    
            // Handle file upload if a profile image is provided
            if ($request->hasFile('profile_image')) {
                // Get file name with the extension
                $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
                // Get just the filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just the extension
                $extension = $request->file('profile_image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . Str::uuid(). '.' . $extension;
                // Upload image
                $path = $request->file('profile_image')->storeAs('public/profile_images', $fileNameToStore);
            } else {
                // Default image if no profile image provided
                $fileNameToStore = 'default_profile_image.jpg';
            }
            
            // Save the user to the database
            $user = new user();
            $user->email = $validatedData['email'];
            $user->name = $validatedData['name'];
            $user->password = bcrypt($validatedData['password']);
            $user->save();
    
            // Create a new user instance
            $provider = new Providers();
            $provider->user_id = $user->id; 
            $provider ->surname = $validatedData['surname'];
            $provider ->firstname = $validatedData['firstname'];
            $provider ->email = $validatedData['email'];
            $provider ->mobile = $validatedData['mobile'];
            $provider ->state = $validatedData['state'];
            $provider ->country = $validatedData['country'];
            $provider ->image = $fileNameToStore; // Save profile image filename
    
            // Save the provider to the database
            $provider ->save();
            Auth::login($user);

            // Redirect or respond with success message
            return response()->json(['message' => 'Registration successful'], 200);
        } catch (ValidationException $e) {
            // Return validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}