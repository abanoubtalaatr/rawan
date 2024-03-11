<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class TapPaymentService
{
    private $apiBaseUrl = 'https://api.tap.company/v2/invoices/';
    private $apiKey = 'sk_test_GM34ihbYXa8wcKjqenoQFHS2'; // Replace with your actual API key

    public function pay($data)
    {
        $invoiceData = [
            'draft' => false,
            'due' => 1672235072000,
            'expiry' => 1672235072000,
            'description' => 'invoice',
            'mode' => 'PAY',
            'customer' => [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => [
                    "country_code" => 965,
                    "number" => 51234567,
                ],
            ],
            'order' => [
                'amount' => 100,
                'currency' => 'KWD', // Corrected currency value
                'items' => [
                    'name' => 'fdslkfds',
                    'amount' => $data['price'],
                    'currency' => 'KWD', // Corrected currency value
                    'description' => 'pay',
                    'quantity' => 1,
                ],
            ],
            'tax' => 0,
            'payment_methods' => ['BENEFIT', 'VISA', 'MASTERCARD', 'APPLE_PAY'],
        ];

        $client = new Client([
            'base_uri' => $this->apiBaseUrl,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);

        $response = $client->post('', [
            'json' => $invoiceData,
        ]);

        return json_decode($response->getBody(), true);
    }

}
