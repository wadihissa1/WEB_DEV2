<?php

namespace App\Http\Controllers;

use App\Mail\EventCreatedNotification;
use App\Models\Bid;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Mail\HighestBidWinnerNotification;

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
        // Set the timezone to your local timezone
        date_default_timezone_set('Asia/Beirut');

        // Fetch events that have already started
        $startedEvents = Event::where('date_time', '<', Carbon::now())
            ->where('status', 'open')
            ->get();

        // Fetch events that haven't started yet
        $upcomingEvents = Event::where('date_time', '>', Carbon::now())->get();

        foreach ($upcomingEvents as $key => $event) {
            if ($event->date_time <= now()) {
                $startedEvents->push($event);
                unset($upcomingEvents[$key]);
                \Log::info("Moved upcoming event {$event->name} to started events list.");
            } else {
                \Log::info("Event {$event->name} has not started yet. DateTime: {$event->date_time}");
                \Log::info("Current DateTime: " . Carbon::now());
            }
        }

        \Log::info("Started events: " . $startedEvents->toJson());
        \Log::info("Upcoming events: " . $upcomingEvents->toJson());

        return view('event.buyereventshow', compact('startedEvents', 'upcomingEvents'));
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


    public function addEventProduct(Request $request, $eventId, $storeId, $productId)
    {
        // Find the product
        $product = Product::findOrFail($productId);

        // Check if the product is already associated with the event
        if ($product->event_id == $eventId) {
            return redirect()->back()->with('error', "Product '{$product->name}' is already associated with this event");
        }

        // Update the product's event_id to associate it with the event
        $product->event_id = $eventId;
        $product->save();

        // Get the event name
        $event = Event::findOrFail($eventId);
        $eventName = $event->name;

        // Redirect back or return a response with success message
        return redirect()->route('vieweventproducts', ['eventId' => $eventId, 'storeId' => $product->store_id])
            ->with('success', "Product '{$product->name}' has been added successfully to event '{$eventName}'");
    }

    public function processClosedEvent($eventId)
    {
        // Retrieve the event by ID
        $event = Event::findOrFail($eventId);

        // Check if the event is closed
        if ($event->status !== 'closed') {
            return; // If the event is not closed, do nothing
        }

        // Retrieve all products associated with the closed event
        $products = $event->products;

        foreach ($products as $product) {
            // Retrieve the highest bid for the product in the closed event
            $highestBid = Bid::where('product_id', $product->id)
                ->where('event_id', $event->id)
                ->max('bid');

            // Retrieve the user who placed the highest bid for the product
            $highestBidder = Bid::where('product_id', $product->id)
                ->where('event_id', $event->id)
                ->where('bid', $highestBid)
                ->first();

            if ($highestBidder) {
                // Retrieve the user associated with the highest bid
                $user = User::findOrFail($highestBidder->user_id);

                // Send an email notification to the user
                Mail::to($user->email)->send(new HighestBidWinnerNotification($user, $product, $highestBid));
            }
        }

        // Optionally, you can log or return a message indicating that the process is complete
        \Log::info("Processed closed event {$event->name}");
    }
    public function closeEvent($eventId)
    {
        // Find the event by ID
        $event = Event::findOrFail($eventId);

        // Update the status to "closed"
        $event->status = 'closed';
        $event->save();

        $this->processClosedEvent($eventId);

        // Redirect back to the page where the button was clicked
        return Redirect::back()->with('success', "Event '{$event->name}' has been closed successfully");
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
