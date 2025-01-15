<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;

class PasswordResetController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);


      /*
       $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        */

        // Generate a unique token
        $token = Str::random(60);

        // Store the token and its expiration time in the password_resets table
        $expiration = Carbon::now()->addHour(); // Set expiration time to 1 hour from now
        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => $expiration,
        ]);

        // Send password reset email
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return response()->json(['message' => 'Password reset email sent.'], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|min:8|confirmed',
        ]);

        $passwordReset = PasswordReset::where('token', $request->token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$passwordReset) {
            return response()->json(['message' => 'Password reset token invalid or expired.'], 400);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Update user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset token from the table
        $passwordReset->delete();

        return response()->json(['message' => 'Password reset successful.'], 200);
    }
}