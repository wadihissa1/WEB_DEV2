<?php

namespace App\Http\Controllers;
use App\Models\StoreRequest;
use App\Models\Store;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index()
    {
        $pendingRequests = StoreRequest::where('status', 'pending')->get();
        $categories = Category::all();
        return view('admindashboard', ['pendingRequests' => $pendingRequests, 'categories' => $categories]);
    }

    public function approveRequest(StoreRequest $storeRequest)
    {
        $storeRequest->status = 'approved';
        $storeRequest->save();

        // Create the store based on the approved request
        Store::create([
            'user_id' => $storeRequest->user_id,
            'name' => $storeRequest->name,
            'description' => $storeRequest->description,
            'status' => 'approved', // Set the status to approved for the store
        ]);

        return redirect()->back()->with('success', 'Store request approved!');
    }

    public function rejectRequest(StoreRequest $storeRequest)
    {
        $storeRequest->status = 'rejected';
        $storeRequest->save();

        return redirect()->back()->with('success', 'Store request rejected.');
    }
    public function viewCategories()
    {
        $categories = Category::all();
        return view('viewcategories', ['categories' => $categories]);
    }
}
