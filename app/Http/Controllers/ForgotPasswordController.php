<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ForgotPasswordController extends Controller
{

    public function showForgotPasswordForm(){
        return view("forgot-password");
}
    public function sendPasswordResetLink(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        // Generate and save password reset token
        $token = Str::random(16);
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Send email with reset link
        $this->sendResetEmail($user->email, $token);

        return redirect()->back()->with('success', 'Password reset link sent! Please check your email.');
    }




    // Method to send password reset email
    public function sendResetEmail($email, $token)
    {
        $resetLink = route('reset.password.form', ['token' => $token]);

        Mail::send('password-reset', ['resetLink' => $resetLink], function ($message) use ($email) {
            $message->to($email)->subject('Reset Your Password');
        });
    }
}
