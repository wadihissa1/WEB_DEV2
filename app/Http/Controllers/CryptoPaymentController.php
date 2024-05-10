<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CoinbaseCommerceService;

class CryptoPaymentController extends Controller
{
    protected $coinbaseService;

    public function __construct(CoinbaseCommerceService $coinbaseService)
    {
        $this->coinbaseService = $coinbaseService;
    }

    public function createCharge(Request $request)
    {
        // Retrieve payment details from the request
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $name = $request->input('name');
        $description = $request->input('description');

        // Create charge via Coinbase Commerce API
        $charge = $this->coinbaseService->createCharge($amount, $currency, $name, $description);

        // Handle response (e.g., redirect user to payment page)
        // Example:
        return redirect()->away($charge['data']['hosted_url']);
    }
}
