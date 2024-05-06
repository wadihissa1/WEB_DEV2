<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;

class FollowController extends Controller
{
    public function follow(Store $store)
    {
        $user = auth()->user();

        // Attach the user to the store
        $store->followers()->attach($user);

        return redirect()->route('viewstore', $store->id)->with('success', "Store followed successfully");
    }

    public function unfollow(Store $store)
    {
        $user = auth()->user();

        // Detach the user from the store
        $store->followers()->detach($user);

        return redirect()->route('viewstore', $store->id)->with('success', "Store unfollowed successfully");
    }
}