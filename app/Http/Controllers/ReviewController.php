<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Store;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        // Validate request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);
    
        // Retrieve the product
        $product = Product::findOrFail($request->product_id);
    
        // Create a new review
        Review::create([
            'user_id' => auth()->id(), // Assuming the user is logged in
            'store_id' => $product->store_id, // Retrieve the store_id from the product
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    
        return back()->with('success', 'Review submitted successfully.');
    }
    
}
