<?php 


// app/Services/CoinbaseCommerceService.php

namespace App\Services;

use GuzzleHttp\Client;

class CoinbaseCommerceService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.commerce.coinbase.com/',
        ]);
        $this->apiKey = config('coinbase.api_key');
    }

    public function createCharge($amount, $currency, $name, $description)
    {
        $response = $this->client->post('charges', [
            'headers' => [
                'Content-Type' => 'application/json',
                'X-CC-Api-Key' => $this->apiKey,
            ],
            'json' => [
                'name' => $name,
                'description' => $description,
                'local_price' => [
                    'amount' => $amount,
                    'currency' => $currency,
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
