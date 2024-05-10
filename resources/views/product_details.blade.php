@extends('layout')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | RedStore</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
    .chatbox-container {
        position: fixed;
        bottom:0;
        right: 20px;
        background-color: #fff;
        z-index: 9999;
    }

    .chatbox {
        width: 300px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: none;
    }

    .chatbox-header {
        padding: 10px;
        background-color: #f0f0f0;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chatbox-body {
        padding: 10px;
        height: 281px;
        overflow-y: auto;
    }

    .chatbox-footer {
        padding: 10px;
        height: fit-content;
        border-top: 1px solid #ccc;
    }

    .chatbox-input {
        width: calc(100% - 68px); /* Adjust based on your needs */
        height: 50px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        float: left;
    }

    .chatbox-send-btn {
        width: 60px;
        height: 50px;
        border: none;
        background-color: #007bff;
        color: #fff;
        border-radius: 3px;
        cursor: pointer;
        float: right;
    }

    .collapse-icon {
        cursor: pointer;
    }
</style>

<body>

    <!-- Single Products -->
    <div class="small-container single-product">

        <div class="row">
            <div class="col-2">
                <img src="{{ asset('/images/product-10.jpg') }}" width="100%" id="ProductImg">

        </div>
        <div class="col-2">

            <p>Home / {{ $product->category->name }}</p>
            <h1>{{ $product->name }}</h1>
            <h4>${{ $product->price }}</h4>
            <input type="number" value="1">

            <form method="post" action="{{ route('cart.add', ['productId' => $product->id]) }}">
                @csrf
                <button type="submit" class="btn">Add to Cart</button>
            </form>

            <h3>Product Details <i class="fa fa-indent"></i></h3>
            <br>
            <p>{{ $product->description }}</p>
            <br><br><br>
            <p>Store : <a href="{{ route('viewstore', ['store' => $store->id]) }}" class="link">{{ $store->name }}</a></p>
            <a href="{{ route('cart.show')}}">view cart</a>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</div>
<!-- title -->
<div class="related-products">
    <h2 class="title">Related Products</h2>
    <div class="row">
        @foreach ($relatedProducts as $relatedProduct)
            <div class="col-4">
                <a href="{{ route('product_details', ['id' => $relatedProduct->id]) }}">
                    <img src="{{ asset('/images/product-10.jpg') }}" alt="Product Image">
                </a>
                <h3>{{ $relatedProduct->name }}</h3>
                <h4>${{ $relatedProduct->price }}</h4>
            </div>
            <div class="col-2">

                <p>Home / {{ $product->category->name }}</p>
                <h1>{{ $product->name }}</h1>
                <h4>${{ $product->price }}</h4>
                <input type="number" value="1">
                <a href="#" class="btn">Add To Cart</a>

                <h3>Product Details <i class="fa fa-indent"></i></h3>
                <br>
                <p>{{ $product->description }}</p>
                <br><br><br>
                <p>Store : <a href="{{ route('viewstore', ['store' => $store->id]) }}"
                        class="link">{{ $store->name }}</a></p>

                <!-- Message icon -->
                <a href="#" id="messageIcon" class="fa fa-comments" style="font-size: 24px; color: blue;"></a>

                <!-- Chatbox -->
                <div class="chatbox-container">
                    <div class="chatbox" id="chatbox">
                        <div class="chatbox-header">
                            Chat with {{ $store->name }}
                            <span id="collapseChat" class="collapse-icon" style="cursor: pointer;font-weight: 900;">-</span>
                            <span id="closeChat" style="cursor: pointer;font-weight: 900;">x</span>
                        </div>
                        <div class="chat_container">
                            <div class="chatbox-body" id="chatboxBody">
                                <!-- Messages will be displayed here -->
                            </div>
                            <div class="chatbox-footer">
                                <textarea id="messageInput" class="chatbox-input" placeholder="Type your message"
                                    rows="3"></textarea>
                                <button id="sendMessageBtn" class="chatbox-send-btn">Send</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- javascript -->

    <script>
        // Message icon click event
        document.getElementById("messageIcon").addEventListener("click", function (e) {
            e.preventDefault();
            document.getElementById("chatbox").style.display = "block"; // Show chatbox
        });

        // Send message button click event
        document.getElementById("sendMessageBtn").addEventListener("click", function () {
            var messageInput = document.getElementById("messageInput").value.trim();
            if (messageInput !== "") {
                // Send the message (you'll implement this functionality)
                // For now, let's just log the message to the console
                console.log("Message:", messageInput);
                // Clear the message input field
                document.getElementById("messageInput").value = "";
            }
        });

        // Close chatbox
        document.getElementById("closeChat").addEventListener("click", function () {
            document.getElementById("chatbox").style.display = "none"; // Hide chatbox
        });

        // Collapse/Expand chatbox
        document.getElementById("collapseChat").addEventListener("click", function () {
            var chatboxBody = document.getElementById("chatboxBody");
            if (chatboxBody.style.display === "none") {
                chatboxBody.style.display = "block"; // Expand chatbox
                document.getElementById("collapseChat").innerText = "-"; // Change collapse icon to "-"
                document.querySelector('.chatbox-footer').style.display = 'block'; // Show footer
            } else {
                chatboxBody.style.display = "none"; // Collapse chatbox
                document.getElementById("collapseChat").innerText = "+"; // Change collapse icon to "+"
                document.querySelector('.chatbox-footer').style.display = 'none'; // Hide footer
            }
        });


    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.3/echo.min.js"></script>

<script>
    import name from 'module-name';
    
    document.addEventListener('DOMContentLoaded', function () {
        var chatboxBody = document.getElementById("chatboxBody");
        var chatbox = document.getElementById("chatbox");

        // Initialize Echo
        window.Echo.private('messages.' + {{ auth()->id() }})
            .listen('.new-message', function (data) {
                // Append the new message to the chatbox body
                var newMessage = document.createElement("div");
                newMessage.innerText = data.message.message;
                chatboxBody.appendChild(newMessage);
                // Scroll to the bottom of the chatbox
                chatboxBody.scrollTop = chatboxBody.scrollHeight;
            });

        // Send message button click event
        document.getElementById("sendMessageBtn").addEventListener("click", function () {
            var messageInput = document.getElementById("messageInput").value.trim();
            if (messageInput !== "") {
                // Send the message to the server
                axios.post('{{ route("messages.store") }}', {
                    receiver_id: {{ $store->id }},
                    message: messageInput
                })
                .then(function (response) {
                    console.log(response.data);
                    // Clear the message input field
                    document.getElementById("messageInput").value = "";
                })
                .catch(function (error) {
                    console.error('Error sending message:', error);
                });
            }
        });
    });
</script>
</body>

</html>
@endsection
