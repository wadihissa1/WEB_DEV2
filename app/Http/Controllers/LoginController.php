<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if($user){
            if (password_verify($request->password, $user->password)) {

                return redirect('/index')->with('success', 'Login successful!');
        }
        }


        return redirect()->back()->withErrors(['login_failed' => 'Invalid email or password']);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            dd($googleUser);
        } catch (\Exception $e) {
            Log::error('Google OAuth ClientException: ' . $e->getMessage());
            return redirect('/account')->withErrors(['error' => 'Google login failed.']);
        }

        // Check if the user exists in your database based on their email
        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            // If the user already exists, log them in
            Log::info('Existing User Details:', $existingUser->toArray());
            Auth::login($existingUser);
            return redirect('/home')->with('success', 'Logged in successfully!');
        } else {
            // If the user doesn't exist, create a new user account
            $newUser = new User();
            $newUser->name = $googleUser->getName();
            $newUser->email = $googleUser->getEmail();
            $newUser->verified = true;
            // You may want to set a random password or leave it empty depending on your application's requirements
            $newUser->password = bcrypt(1234);
            // Alternatively, you can redirect the user to a page to set their password after registration
            // $newUser->password = null;
            $newUser->save();

            // Log in the newly created user
            Auth::login($newUser);

            return redirect('/product')->with('success', 'Registered and logged in successfully!');
        }
    }
}
