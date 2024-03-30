<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalPaymentService
{

    public function pay($data)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
       $url =  url('/'). "/api/payment?payment_type=paypal&booking_id=". $data['id'];

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => url('/'). "/api/payment?payment_type=paypal&booking_id=". $data['id'],
//                "cancel_url" => url('/'). "/api/payment?payment_type=paypal&booking_id=". $data['id'],
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $data['price']
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return $links['href'];
                }
            }

        } else {
            return redirect()
                ->route('/')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
