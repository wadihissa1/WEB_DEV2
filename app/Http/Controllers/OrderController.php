<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        // Retrieve all orders from the database
        $orders = Order::all();

        // Return the orders data as a JSON response
        return view('payments.form');
    }


    public function store(Request $request)
    {
        $user = $request->user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
    
        $totalPrice = 0;
    
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
    
            if ($product) {
                $itemTotalPrice = $product->price * $cartItem->quantity;
                $totalPrice += $itemTotalPrice;
    
                // Debug: Output product details
                info("Product ID: {$product->id}, Name: {$product->name}, Price: {$product->price}, Quantity: {$cartItem->quantity}, Item Total Price: {$itemTotalPrice}");
            } else {
                // Handle case where product is not found
                info("Product not found for CartItem ID: {$cartItem->id}");
            }
        }
    
        info("Final Total Price: {$totalPrice}");
    
        // Create a new Order instance
        $order = new Order();
        $order->user_id = $user->id;
        $order->status = 'completed';
        $order->payment_method = 'cash on delivery';
    
        // Set the calculated total price
        $order->total_price = $totalPrice;
    
        // Save the order to the database
        $order->save();
    
        // Attach products to the order
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            
            if ($product) {
                $order->products()->attach($product->id, [
                    'quantity' => $cartItem->quantity,
                    'price' => $product->price
                ]);
            }
        }
    
        // Clear cart items after placing the order
        CartItem::where('user_id', $user->id)->delete();
    
        // Redirect to the orders index with success message
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}