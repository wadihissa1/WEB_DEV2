<?php

namespace App\Http\Controllers;

use App\Mail\EventCreatedNotification;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{


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

        $recipient = 'wadihpsplus@gmail.com';
        Mail::to($recipient)->send(new EventCreatedNotification($event));
        dd($request->all());
        // Optionally, redirect the user to a relevant page or show a success message
       // return redirect()->route('events.show', $event->id)->with('success', 'Event created successfully');
    }
}
