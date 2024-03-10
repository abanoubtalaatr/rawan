<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class TapPaymentService
{
    private $apiBaseUrl = 'https://api.tap.company/v2/invoices/';
    private $apiKey = 'sk_test_GM34ihbYXa8wcKjqenoQFHS2'; // Replace with your actual API key

    public function pay($data)
    {

        $data = [
            'draft' => false,
            'due' => 1672235072000,
            'expiry' => 1672235072000,
            'description' => 'invoice',
            'mode' => 'PAY',
            'customer' => [
                'id' => 393939,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => [
                    'country_code' => 966,
                    'number' => $data['mobile'],
                ],
            ],
            'order' => [
                'amount' => 100,
                'currency' => 'SAR',
                'items' => [
                    'product_id' => rand(1000, 9999),
                    'amount' => $data['price'],
                    'currency' => 'SAR',
                    'description' => 'pay',
                    'quantity' => 1,
                ],
            ],
            'tax' => 0,
            'payment_methods' => ['BENEFIT', 'VISA', 'MASTERCARD', 'APPLE_PAY'],
        ];
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey,
        ];

        $response = Http::withHeaders($headers)->post($this->apiBaseUrl, $data);

        return $response->json();

    }
}
