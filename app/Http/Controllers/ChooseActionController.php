<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Store;
use App\Models\StoreRequest;

use Illuminate\Http\Request;

class ChooseActionController extends Controller
{

    public function index()
    {
        $userId = auth()->id(); // Get the ID of the currently authenticated user
        return view('chooseaction', compact('userId'));
    }
}
