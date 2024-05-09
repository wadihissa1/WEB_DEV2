<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    // Display the Reset Password Form
    public function showResetPasswordForm($token)
    {
        // Validate token and show the reset password form
        $resetData = DB::table('password_resets')->where('token', $token)->first();

        if (!$resetData) {
            // Token not found, handle accordingly (redirect to error page, show error message, etc.)
            abort(404);
        }

        return view('reset-password', ['token' => $token]);
    }

    // Handle the Password Reset
    public function resetPassword(Request $request)
    {
        // Validate form data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // User not found, handle accordingly
            return redirect()->route('account')->with('error', 'Invalid email.');
        }

        // Update user's password
        $user->update(['password' => Hash::make($request->password)]);

        // Delete the password reset token
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Redirect the user to login page with success message
        return redirect()->route('account')->with('success', 'Your password has been reset successfully.');
    }
}
