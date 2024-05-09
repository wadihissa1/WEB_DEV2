@extends('layout')

@section('content')
    <h1>Event: {{ $event->name }}</h1>
    <p>Description: {{ $event->description }}</p>

    <h2>Products for Bidding</h2>
    @if ($products->isEmpty())
        <p>No products available for bidding.</p>
    @else
        <form id="bidform" method="POST" action="{{ route('place.bid') }}">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <input type="text" name="user_id" value="{{ auth()->id() }}">

            <div class="product-cards">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="product-info">
                            <input type="radio" name="product_id" id="product_{{ $product->id }}" value="{{ $product->id }}">
                            <label for="product_{{ $product->id }}">{{ $product->description }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div>
                <label for="bid_amount">Enter Bid Amount:</label>
                <input type="number" name="bid" id="bid" step="0.01" min="0">
            </div>

            <div>
                <button type="submit">Place Bid</button>
            </div>
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

        // Initialize variables
        var highestBids = {};
        var minimumRaise = 10; // Example: Minimum raise of $10

        channel.bind('NewBid', function(data) {
            var bid = data.bid;

            // Calculate the minimum acceptable bid amount
            var minimumBid = (highestBids[bid.product.id] || 0) + minimumRaise;


            // Check if the new bid meets the minimum raise requirement
            if ((bid.bid - (highestBids[bid.product.id] || 0)) < minimumRaise) {
                // Append a message to the page indicating that the bid was below the minimum raise requirement
                var bidsDiv = document.getElementById('bids');
                bidsDiv.innerHTML += '<p>The bid was below the minimum raise requirement. Minimum raise: ' + minimumRaise + '</p>';
                return; // Do not process the bid further
            }


            // Update highest bid for this product if it's higher than the current highest bid
            if (!highestBids[bid.product.id] || bid.bid > highestBids[bid.product.id]) {
                highestBids[bid.product.id] = bid.bid;
            }

            // Append new bid information to the page
            var bidInfo = '<b>' + bid.user.name + '</b> has placed a bid of <b>' + bid.bid + '</b> on the product <b>' + bid.product.name + '</b>. Highest bid: <b>' + highestBids[bid.product.id] + '</b>';
            console.log("New Bid:", bidInfo);
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

