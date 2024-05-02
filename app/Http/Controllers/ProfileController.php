<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function edit($userId)
    {
        // Retrieve the user information based on the provided user ID
        $user = User::find($userId);

        // Check if the user exists
        if (!$user) {
            // Handle the case where the user is not found (e.g., show an error message or redirect)
            return redirect()->back()->with('error', 'User not found.');
        }

        // Pass the user information to the view
        return view('profile.edit', compact('user'));
    }
    public function update(Request $request, $userId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$userId,
            // Add validation rules for other fields as needed
        ]);

        // Retrieve the user based on the provided user ID
        $user = User::find($userId);

        // Check if the user exists
        if (!$user) {
            // Handle the case where the user is not found (e.g., show an error message or redirect)
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update the user information
        $user->update($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
