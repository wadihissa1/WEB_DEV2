@extends('layout')

@section('content')
    <h1>Events for Buyers</h1>

    <h2>Started Events</h2>
    @if ($startedEvents->isEmpty())
        <p>No started events found.</p>
    @else
        <ul>
            @foreach ($startedEvents as $event)
                <li><a href="{{ route('event.details', ['eventId' => $event->id]) }}">{{ $event->name }}</a></li>
                <!-- Add more event details if needed -->
            @endforeach
        </ul>
    @endif

    <h2>Upcoming Events</h2>
    @if ($upcomingEvents->isEmpty())
        <p>No upcoming events found.</p>
    @else
        <ul>
            @foreach ($upcomingEvents as $key => $event)
                @if ($event->date_time <= now())
                    {{-- Move the event to the started events list --}}
                    @php
                        $startedEvents->push($event);
                        unset($upcomingEvents[$key]);
                    @endphp
                @else
                    <li>
                        <p>{{ $event->name }}</p>
                        <a href="https://outlook.live.com/calendar/0/action/compose?allday=false&body={{ urlencode($event->description) }}&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent&startdt={{ urlencode(date('Y-m-d\TH:i:s', strtotime($event->date_time))) }}&subject={{ urlencode($event->name) }}"
                           title="Save Event in my Calendar" target="_blank" rel="nofollow">Save Event in my Calendar</a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
@endsection
