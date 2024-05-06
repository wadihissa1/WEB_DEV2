<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Store;
use App\Models\StoreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChooseActionController extends Controller
{

    public function index()
    {
        $userId =Auth::user(); // Get the ID of the currently authenticated user
        return view('chooseaction',['id' => $userId]);
    }
}
