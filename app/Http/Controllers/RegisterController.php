<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function register(Request $request)
    {  try{
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
         $user->email = $request->email;
          $user->password = bcrypt($request->password);
           $user->role = $request->role;
       $user->save();
            return "Registration successful!";
        } catch (\Exception $e) {
        // Log or display the full exception message
        return $e->getMessage();
    }


    }
}
