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
        (new TapPaymentService())->pay($data);

        return $this->sendResponse(null, 'تم الحجز');
    }
}
