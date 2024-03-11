<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Service\TapPaymentService;
use Illuminate\Http\Request;

class BookingController extends BaseController
{
    public function store(BookingRequest $request)
    {
        $data = $request->validated();
        $booking = Booking::query()->create($data);
//        $data['type'] = "consultation";

        // Assume that pay() returns the redirect URL after processing the payment
//        $redirectUrl = (new TapPaymentService())->pay($data);

//        $dataUrl['url'] = $redirectUrl;
//        return $this->sendResponse($dataUrl, 'استخدم هذا الرابط لتحويل المستخدم الي بوابه الدفع');
        // Redirect the user to the specified URL
        return $this->sendResponse($booking, null);
    }

}
