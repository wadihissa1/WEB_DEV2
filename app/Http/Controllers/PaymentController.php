<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class PaymentController extends Controller
{

    public function pay(Request $request)
    {
        // Retrieve total amount from the request
        $totalAmount = $request->input('totalAmount');

        // Process payment using Stripe
        try {
            $charge = Stripe::charges()->create([
                'amount' => $totalAmount,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Payment for Order',
            ]);

            // Payment successful, redirect to success page
            return redirect()->route('payments.success')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            // Payment failed, redirect to cancel page with error message
            return redirect()->route('payments.cancel')->with('error', $e->getMessage());
        }
    }

    public function paymentSuccess()
    {
        // Payment successful page
        return view('payments.success');
    }

    public function paymentCancel()
    {
        // Payment cancelled or failed page
        return view('payments.cancel');
    }
}
