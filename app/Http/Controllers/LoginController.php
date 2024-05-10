<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\StoreRequest;
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

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->verified) {
                // Check if the user is a "seller"
                if ($user->role === 'seller') {
                    return redirect()->route('chooseaction', ['id' => $user->id]);
                }

                // If not a "seller", redirect to the default page (product route in this case)
                return redirect()->route('product', ['id' => $user->id]);
            } else {
                // If the user is not verified, redirect them back with an error message
                Auth::logout();
                return redirect()->back()->withErrors(['login_failed' => 'Your account is not verified. Please verify your email before logging in.']);
            }
        }

        // If the email or password is incorrect, redirect them back with an error message
        return redirect()->back()->withErrors(['login_failed' => 'Invalid email or password']);
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Redirect the user to the login page
        return redirect('/account');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            dd($e);
            Log::error('Google OAuth ClientException: ' . $e->getMessage());
            return redirect('/account')->withErrors(['error' => 'Google login failed.']);
        }

        // Check if the user exists in your database based on their email
        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            // If the user already exists, log them in
            Log::info('Existing User Details:', $existingUser->toArray());
            Auth::login($existingUser);
            return redirect()->route('product', ['id' => $existingUser->id]);
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

            return redirect()->route('product', ['id' => $newUser->id]);
        }
    }

    public function redirectToGitHub(){

        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            Log::error('GitHub OAuth ClientException: ' . $e->getMessage());
            return redirect('/account')->withErrors(['error' => 'GitHub login failed.']);
        }

        // Check if the user exists in your database based on their email
        $existingUser = User::where('email', $githubUser->getEmail())->first();

        if ($existingUser) {
            // If the user already exists, log them in
            Auth::login($existingUser);
            return redirect()->route('product', ['id' => $existingUser->id]);
        } else {
            // If the user doesn't exist, create a new user account
            $newUser = new User();
            $newUser->name = $githubUser->getName() ?? 'GitHub User';
            $newUser->email = $githubUser->getEmail();
            $newUser->verified = true;
            // You may want to set a random password or leave it empty depending on your application's requirements
            $newUser->password = bcrypt(1234);
            // Alternatively, you can redirect the user to a page to set their password after registration
            // $newUser->password = null;
            $newUser->save();

            // Log in the newly created user
            Auth::login($newUser);

            return redirect()->route('product', ['id' => $newUser->id]);
        }
    }


    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

}
