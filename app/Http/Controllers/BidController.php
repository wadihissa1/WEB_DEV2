<?php

namespace App\Http\Controllers;

use App\Event\NewBid;
use App\Models\Bid;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BidController extends Controller
{


    public function showEventProducts($eventId)
    {
        // Assuming you have Event and Product models imported at the top of the controller
        $event = Event::findOrFail($eventId);
        $products = $event->products;

        return view('event.bid', compact('event', 'products'));
    }


    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'bid' => 'required|numeric',
                'product_id' => 'required|exists:products,id',
                'user_id' => 'required|exists:users,id',
                'event_id' => 'required|exists:events,id',

            ]);

            // Create the bid
            $bid = Bid::create([
                'bid' => $validatedData['bid'],
                'product_id' => $validatedData['product_id'],
                'user_id' => $validatedData['user_id'],  // Use userId from form data
                'event_id' => $validatedData['event_id'], // Include event_id
            ]);

            // Broadcast the new bid event
            broadcast(new NewBid($bid))->toOthers();

            return response()->json(['bid' => $bid]);
        } catch (\Exception $e) {
            // Log the exception with detailed information
            \Log::error('Error creating bid: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e,
            ]);

            // Return error response
            return response()->json(['error' => 'Failed to place bid. Please try again.'], 500);
        }
    }

}
