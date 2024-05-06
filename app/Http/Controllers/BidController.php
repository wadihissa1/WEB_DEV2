<?php

namespace App\Http\Controllers;

use App\Event\NewBid;
use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{


    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'bid' => 'required|numeric',
            'product_id' => 'required|exists:products,id',
            'event_id' => 'required|exists:events,id',
        ]);

        // Create the bid
        $bid = Bid::create([
            'bid' => $validatedData['bid'],
            'product_id' => $validatedData['product_id'],
            'user_id' => auth()->id(),
        ]);

        // Broadcast the new bid event
        broadcast(new NewBid($bid))->toOthers();

        return response()->json(['message' => 'Bid placed successfully']);
    }
}
