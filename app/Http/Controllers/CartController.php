<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use App\Models\CartItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{




    public function addToCart(Request $request, $productId)
{
    $product = Product::findOrFail($productId);

    // Retrieve current cart items from session
    $cartItems = $request->session()->get('cart.items', []);

    // Check if the product already exists in the cart
    if (isset($cartItems[$product->id])) {
        // Increment quantity if product already exists
        $cartItems[$product->id]['quantity']++;
    } else {
        // Add new product to cart
        $cartItems[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' =>$product->quantity,
        ];
    }

    // Store updated cart items back into session
    $request->session()->put('cart.items', $cartItems);

    // Redirect back to the store or product page
    return redirect()->back()->with('success', 'Product added to cart!');
}

public function showCart()
{
    // Retrieve cart items from session
    $cartItems = session()->get('cart.items', []);
    
    // Calculate total price
    $totalPrice = 0;

    foreach ($cartItems as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    // Pass cartItems and totalPrice to the view
    return view('cartblade', compact('cartItems', 'totalPrice'));
}

   

    public function updateCart(Request $request, $productId)
    {
        // Retrieve the new quantity from the form submission
        $newQuantity = $request->input('quantity');

        // Retrieve current cart items from session
        $cartItems = $request->session()->get('cart.items', []);

        // Check if the product exists in the cart
        if (isset($cartItems[$productId])) {
            // Update the quantity of the specific product
            $cartItems[$productId]['quantity'] = $newQuantity;

            // Store the updated cart items back into the session
            $request->session()->put('cart.items', $cartItems);
            
            // Redirect back to the cart page with a success message
            return redirect()->route('cart.show')->with('success', 'Cart updated successfully!');
        } else {
            // Product not found in cart (handle error or redirect)
            return redirect()->route('cart.show')->with('error', 'Product not found in cart!');
        }
    }

    public function clearCart(Request $request)
    {
        $request->session()->forget('cart.items'); // Clear the cart items from session
        return redirect()->route('cart.show')->with('success', 'Cart cleared successfully!');
    }

    public function convertCurrency(Request $request)
    {
        $currency = $request->input('currency'); // Get selected currency (e.g., 'EUR' or 'GBP')
        
        // Retrieve cart items from session
        $cartItems = session()->get('cart.items', []);
        
        // Calculate total price in USD
        $totalPriceUSD = 0;
        
        foreach ($cartItems as $item) {
            $totalPriceUSD += $item['price'] * $item['quantity'];
        }
        
        // Build the API request URL with the desired currency
        $reqUrl = "https://v6.exchangerate-api.com/v6/6f05ccdf22ce1ca848a39094/latest/USD";
        
        // Make the API call using file_get_contents
        $responseJson = file_get_contents($reqUrl);
        
        // Handle API response
        $response = json_decode($responseJson);
        
        if ($response && $response->conversion_rates) {
            $conversionRate = $response->conversion_rates->$currency ?? 1;
        
            // Convert the total price based on the currency
            $convertedTotalPrice = $totalPriceUSD * $conversionRate;
        
            // Perform currency formatting based on user's currency preference
            $formattedPrice = number_format($convertedTotalPrice, 2);
        
            // Pass data to the view
            return view('cartblade', compact('cartItems', 'totalPriceUSD', 'currency', 'formattedPrice'));
        } else {
            // Handle API request failure
            return redirect()->back()->with('error', 'Failed to convert price. Please try again later.');
        }
    }
        
    }