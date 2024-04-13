<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

            // Create a new user instance
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->save();

            // Send email verification
            $this->sendEmailVerification($user);

            return "Registration successful! Please check your email to verify your account.";
        } catch (\Exception $e) {
            // Log or display the full exception message
            return $e->getMessage();
        }
    }

    // Method to send email verification
    protected function sendEmailVerification($user)
    {
        // Generate a unique token for email verification
        $verificationToken = md5(uniqid());

        // Update the user's verification token and save the user
        $user->email_verification_token = $verificationToken;
        $user->save();

        // Send the verification email
        Mail::to($user->email)->send(new EmailVerification($user));
    }
}
