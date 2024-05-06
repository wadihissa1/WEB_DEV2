<?php

namespace App\Http\Controllers;

use App\Mail\EventCreatedNotification;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Create a new event record in the database
        $event = Event::create([

            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date_time' => $validatedData['date'] . ' ' . $validatedData['time'],
        ]);

        $recipient = 'wadihpsplus@gmail.com';
        Mail::to($recipient)->send(new EventCreatedNotification($event));
        dd($request->all());
        // Optionally, redirect the user to a relevant page or show a success message
       // return redirect()->route('events.show', $event->id)->with('success', 'Event created successfully');
    }
}
