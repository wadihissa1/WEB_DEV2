@extends('layout')

@section('content')
    <h1>Event Details: {{ $event->name }}</h1>
    <p>Description: {{ $event->description }}</p>

    <h2>Products for Bidding</h2>
    @if ($products->isEmpty())
        <p>No products available for bidding.</p>
    @else
        <form id="bidform" method="POST" action="{{ route('place.bid') }}">
            @csrf
            <input type="text" name="event_id" value="{{ $event->id }}">
            <label for="product">Select Product:</label>
            <select name="product_id" id="product_id">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <label for="bid_amount">Enter Bid Amount:</label>
            <input type="number" name="bid" id="bid" step="0.01" min="0">
            <button type="submit">Place Bid</button>
        </form>

    @endif
    <div id="bids">
        <!-- Existing bids will be appended here -->
    </div>
@endsection
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });
        Pusher.logToConsole = true;

        var event_id = '{{ $event->id }}';
        console.log("Event ID:", event_id);
        // Subscribe to the channel for bid updates
        var channel = pusher.subscribe('event-' + event_id);

        channel.bind('pusher:subscription_succeeded', function(members) {
            console.log('successfully subscribed!');
        });

        // Bind to the 'new-bid' event
        channel.bind('NewBid', function(data) {
            var bid = data.bid;
            var bidInfo = 'Product ID: ' + bid.product_id + ', New Bid: ' + bid.bid;
            console.log("New Bid:", bidInfo);
            // Append new bid information to the page
            var bidsDiv = document.getElementById('bids');
            bidsDiv.innerHTML += '<p>' + bidInfo + '</p>';
        });


        $(document).ready(function() {
            $('#bidform').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Submit the form data asynchronously using AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(data) {
                        // Append the new bid information to the page

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

