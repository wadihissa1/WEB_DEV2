<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\StoreRequest;
class StoreController extends Controller
{

    
    public function create()
    {
        return view('createstore');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $user = auth()->user();

        // Create a store request
        $storeRequest = StoreRequest::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('chooseaction', ['id' => $user->id]);
    }

    public function view($storeId)
    {
        $store = Store::findOrFail($storeId);
        return view('viewstore', ['store' => $store]);
    }

    public function viewAllStores()
    {
        $user = auth()->user();

        // Get only the approved stores
        $userStores = Store::where('user_id', $user->id)
                            ->where('status', 'approved')
                            ->get();

        return view('viewallstore', [
            'userStores' => $userStores,
        ]);

    }

}
