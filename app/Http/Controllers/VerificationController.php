<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\StoreRequest;
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

        // Check if the user is a "seller"
        if ($user->role === 'seller') {
            return redirect()->route('chooseaction', ['id' => $user->id]);
        }

        // Redirect the user to a page indicating successful verification
        return redirect()->route('product', ['id' => $user->id]);
    }
}
