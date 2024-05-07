@extends('layout')

@section('content')
    <h1>Events for Store</h1>

    @if ($events->isEmpty())
        <p>No events found for this store.</p>
    @else
        <ul>
            @foreach ($events as $event)
                <li><a href="{{ route('vieweventproducts', ['eventId' => $event->id, 'storeId' => $storeId]) }}">{{ $event->name }}</a></li>
            @endforeach
        </ul>
    @endif
@endsection
