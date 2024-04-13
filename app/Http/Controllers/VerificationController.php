<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail(Request $request, $token)
    {
        // Find the user by the verification token
        $user = User::where('email_verification_token', $token)->first();

        // If user not found or already verified, return appropriate response
        if (!$user || $user->verified) {
            return "Invalid or expired verification link.";
        }

        // Mark the user as verified
        $user->verified = true;
        $user->email_verification_token = null; // Optional: Clear the verification token
        $user->save();

        // Optionally, you can log in the user after email verification
        // Auth::login($user);

        // Redirect the user to a page indicating successful verification
        return "Email verification successful!";
    }
}
