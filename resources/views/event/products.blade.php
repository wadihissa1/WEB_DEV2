@extends('layout')

@section('content')
    <h1>Products for Event</h1>

    @if ($products->isEmpty())
        <p>No products found for this event.</p>
    @else
        <ul>
            @foreach ($products as $product)
                <li>{{ $product->name }}</li>
                <!-- Add option to add product to event -->
                <form method="POST" action="{{ route('addeventproduct', ['eventId' => $eventId, 'storeId' => $storeId, 'productId' => $product->id]) }}">
                    @csrf
                    <button type="submit">Add to Event</button>
                </form>
            @endforeach
        </ul>
    @endif
@endsection
