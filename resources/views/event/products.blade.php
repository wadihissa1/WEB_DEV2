@extends('layout')

@section('content')

    <a href="{{ route('viewallstores') }}" class="btn btn-primary">Go Back to Stores</a>
    <a href="{{ route('viewevents', ['storeId' => $storeId]) }}" class="btn btn-primary">View All Events</a>
    <h1>Products for Event</h1>




    @if ($products->isEmpty())
        <p>No products found for this event.</p>
    @else
        @php
            $noProductsInStore = true;
        @endphp
        <ul>
            @foreach ($products as $product)
                @if ($product->event_id != $eventId)
                    @php
                        $noProductsInStore = false;
                    @endphp
                    <li>{{ $product->name }}</li>
                    <!-- Add option to add product to event -->
                    <form method="POST" action="{{ route('addeventproduct', ['eventId' => $eventId, 'storeId' => $storeId, 'productId' => $product->id]) }}">
                        @csrf
                        <button type="submit">Add to Event</button>
                    </form>
                @endif
            @endforeach
        </ul>



        @if ($noProductsInStore)
            <p>No products available in the store that are not associated with this event.</p>
        @endif
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
@endsection
