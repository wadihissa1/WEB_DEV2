<?php

namespace App\Http\Controllers;

use App\Mail\EventCreatedNotification;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{

    public function eventDetails($eventId)
    {
        $event = Event::findOrFail($eventId); // Fetch event details
        $products = $event->products; // Fetch products associated with the event

        return view('event_details', compact('event', 'products'));
    }

    public function buyerEvents()
    {
        $events = Event::all(); // Fetch all events

        return view('event.buyereventshow', compact('events'));
    }

    public function viewEvents($storeId)
    {
        $events = Event::where('store_id', $storeId)->get();
        return view('event.showall', compact('events', 'storeId'));
    }

    public function viewEventProducts($eventId, $storeId)
    {
        // Retrieve products for the specified store
        $products = Product::where('store_id', $storeId)->get();

        // Pass the event ID, store ID, and products to the view
        return view('event.products', compact('eventId', 'storeId', 'products'));
    }


    public function addEventProduct(Request $request, $eventId, $productId)
    {
        // Find the product
        $product = Product::findOrFail($productId);

        // Update the product's event_id to associate it with the event
        $product->event_id = $eventId;
        $product->save();

        // Redirect back or return a response
        return redirect()->route('vieweventproducts', ['eventId' => $eventId, 'storeId' => $product->store_id])
            ->with('success', 'Product added to event successfully');
    }


    public function create()
    {
        $user = Auth::user();
        $userStores = Store::where('user_id', $user->id)
            ->where('status', 'approved')
            ->get();

        return view('event.create', compact('userStores'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'store' => 'required|exists:stores,id', // Validate the store ID
        ]);

// Create a new event record in the database
        $event = Event::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date_time' => $validatedData['date'] . ' ' . $validatedData['time'],
            'store_id' => $validatedData['store'], // Assign the selected store ID
        ]);

        $productsToAdd = Product::where('store_id', $validatedData['store'])->get();

        // Associate each product with the newly created event
        foreach ($productsToAdd as $product) {
            $product->event_id = $event->id;
            $product->save();
        }


        $recipient = 'wadihpsplus@gmail.com';
        Mail::to($recipient)->send(new EventCreatedNotification($event));
        dd($request->all());
        // Optionally, redirect the user to a relevant page or show a success message
       // return redirect()->route('events.show', $event->id)->with('success', 'Event created successfully');
    }
}
