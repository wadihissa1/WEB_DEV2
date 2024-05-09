<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        /* Reset default margin and padding */
        body, h1, p, table {
            margin: 0;
            padding: 0;
        }

        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #e67e22; /* Orange color */
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #e67e22;
            color: #fff;
        }

        /* Form styles */
        form {
            margin-bottom: 20px;
        }

        input[type="number"] {
            width: 60px;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            background-color: #e67e22;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #d35400; /* Darker orange on hover */
        }

        /* Total price and converted price styles */
        .price-info {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .converted-price {
            font-size: 16px;
        }

        /* Empty cart message */
        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Shopping Cart</h1>

    @if (count($cartItems) > 0)
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>${{ $item['price'] }}</td>
                        <td>
                            <form method="post" action="{{ route('cart.update', ['productId' => $item['id']]) }}">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>${{ $item['price'] * $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Calculate and display total price in USD -->
        @php
            $totalPriceUSD = 0;
            foreach ($cartItems as $item) {
                $totalPriceUSD += $item['price'] * $item['quantity'];
            }
        @endphp
        <p class="price-info">Total Price in USD: ${{ $totalPriceUSD }}</p>

        <!-- Currency conversion form -->
        <form method="post" action="{{ route('cart.convert') }}">
            @csrf
            <input type="hidden" name="totalPriceUSD" value="{{ $totalPriceUSD }}">
            <button type="submit" name="currency" value="EUR">Convert to Euro</button>
            <button type="submit" name="currency" value="GBP">Convert to GBP</button>
        </form>

        <!-- Display converted price if available -->
        @isset($formattedPrice)
            <p class="converted-price">Total Price converted to {{ $currency }}: {{ $formattedPrice }} {{ $currency }}</p>
        @endisset

        <!-- Clear cart button -->
        <form method="post" action="{{ route('cart.clear') }}">
            @csrf
            <button type="submit">Clear Cart</button>
        </form>

        <!-- Form to place order -->
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <button type="submit">Place Order</button>
        </form>
    @else
        <p class="empty-cart">Your cart is empty.</p>
    @endif
</body>
</html>