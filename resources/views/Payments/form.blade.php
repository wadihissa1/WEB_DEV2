
@extends('layout')
@section('content')
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            background-color: #f5f5f5;
            background-image: url("/images/createstore-background.webp");
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
        }

        .form-container {
            background: radial-gradient(#fff, #ffd6d6);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            border: 2px solid #2b282825;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 90px auto;
        }

        h1 {
            text-align: center;
            margin: 30px auto;
            color: #ff523b;
            font-size: 55px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            border-color: #ff523b;
        }

        button {
            background-color:  #ff523b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #fff;
            color: #d63a1e;
            border: 1px solid #d63a1e;
        }
        .category{
            display: flex;
            justify-content: space-between;
            margin: 5px auto;
        }
</style>
<body>

<h1>Checkout</h1>

<div id="error-message"></div>

<form id="checkout-form">
    <label for="card-element">
        Credit or debit card
    </label>
    <br><br><br>
    <textarea name="" id="" cols="30" rows="10">Full Name :</textarea>
    <br>
    <input  name="amount" placeholder="ex.JOE">
    <br>
    <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <br><br>
    <div id="card-errors" role="alert" style="color: #d63a1e"></div>
<br><br><br>
    <button id="submit-button" type="submit">Pay</button>
</form>

<h1>Pay With Crypto</h1>

<form action="{{ route('payment.create') }}" method="post">
    @csrf
    <input  name="amount" placeholder="ex.100.00">
    <input  name="currency" placeholder="ex.USD">
    <input  name="name" placeholder="ex.Product Name">
    <input  name="description" placeholder="ex.Product Description">
    <button type="submit">Pay with Coinbase Commerce</button>
</form>

<script>
    // Create a Stripe client.
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Create an instance of the card Element.
    var card = elements.create('card');

    // Add an instance of the card Element into the `card-element` div.
    card.mount('#card-element');

    // Handle form submission.
    var form = document.getElementById('checkout-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server.
        var form = document.getElementById('checkout-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form.
        form.submit();
    }
</script>

</body>
</html>
@endsection