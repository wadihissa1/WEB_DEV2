@extends('layout')

@section('content')

    <a href="/viewallstores/{id}" class="btn btn-primary">Go Back to Stores</a>
    <h1>Events for Store</h1>

    @if ($events->isEmpty())
        <p>No events found for this store.</p>
    @else
        <ul>
            @foreach ($events as $event)
                <li>
                    <a href="{{ route('vieweventproducts', ['eventId' => $event->id, 'storeId' => $storeId]) }}">{{ $event->name }}</a>
                    @if ($event->status === 'open')
                        <form method="POST" action="{{ route('closeevent', ['eventId' => $event->id]) }}" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">Close Event</button>
                        </form>
                    @else
                        <span class="badge badge-secondary">Closed</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection
