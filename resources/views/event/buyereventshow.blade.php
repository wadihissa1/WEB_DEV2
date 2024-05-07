@extends('layout')

@section('content')
    <h1>Events for Buyers</h1>

    @if ($events->isEmpty())
        <p>No events found.</p>
    @else
        <ul>
            @foreach ($events as $event)
                <li><a href="{{ route('event.details', ['eventId' => $event->id]) }}">{{ $event->name }}</a></li>
                <!-- Add more event details if needed -->
            @endforeach
        </ul>
    @endif
@endsection
<script>
    console.log("hello")
</script>
