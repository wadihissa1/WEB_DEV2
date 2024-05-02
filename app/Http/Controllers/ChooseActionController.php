<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ChooseActionController extends Controller
{
   
    public function index()
{
   // $user = auth()->user();
    $userId = auth()->id(); // Get the ID of the currently authenticated user
    return view('chooseaction', compact('userId'));
}
}
