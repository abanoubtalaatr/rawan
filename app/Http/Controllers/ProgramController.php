<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Booking;
use App\Models\Program;
use App\Service\TapPaymentService;
use Illuminate\Http\Request;

class ProgramController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(ProgramResource::collection(Program::query()->get()), null);
    }

    public function store(BookingProgramRequest $request)
    {
        $data = $request->validated();
        $booking = Booking::query()->create($data);
        (new TapPaymentService())->pay($data);

        return $this->sendResponse(null, 'تم الحجز');
    }
}
