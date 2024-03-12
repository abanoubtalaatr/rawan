<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class TapPaymentService
{
    private $apiBaseUrl = 'https://api.tap.company/v2/invoices/';
    private $apiKey = 'sk_test_52zMsLc1fQ8mejPWTE3bVGgh'; // Replace with your actual API key

    public function pay($data)
    {
        $invoiceData = [
            "draft" => false,
            "due" => 16722350724000,
            "expiry" => 16722350742000,
            "description" => $data['type'],
            "mode" => "PAY",
            "customer" => [
                "first_name" => $data['first_name'],
                "last_name" => $data['last_name'],
                "email" => $data['email'],
                "phone" => [
                    "country_code" => 966,
                    "number" => $data['mobile']
                ]
            ],
            "post" => [
                'url' =>  url('/'). "/api/payment?booking_id=". $data['id'],
            ],
            "redirect" =>[
              'url' =>  url('/'). "/api/payment?booking_id=". $data['id'],
            ],
            "order" => [
                "amount" => $data['price'],
                "currency" => "SAR",
                "items" => [
                    [
                        "name" => $data['type'],
                        "amount" => $data['price'],
                        "currency" => "SAR",
                        "quantity" => 1
                    ]
                ]
            ],
            "tax" => 0,
            "payment_methods" => ["BENEFIT", "VISA", "MASTERCARD", "APPLE_PAY"]
        ];


        $client = new \GuzzleHttp\Client();

        $request = $client->post($this->apiBaseUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'json' => $invoiceData, // Include data in the request body as JSON
        ]);

        $response = json_decode($request->getBody()->getContents(), true);

        if(isset($response['url'])){
            return $response['url'];
        }else{
            return false;
        }
    }


}
