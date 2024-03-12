<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingPackageRequest;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ProgramResource;
use App\Models\Booking;
use App\Models\Program;
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


    public  function bookingPackage(BookingPackageRequest $request)
    {
        $data = $request->validated();
        $program = Program::query()->create($data);

        return $this->sendResponse(ProgramResource::make($program), null);
    }

    public function bookingPackages()
    {
        $packages = Booking::query()->whereNotNull('package_id')->get();

        return $this->sendResponse(BookingResource::collection($packages), null);
    }
    public function bookingConsultations()
    {
        $consultations = Booking::query()->whereNotNull('consultation_id')->get();

        return $this->sendResponse(BookingResource::collection($consultations), null);
    }

    public function bookingPrograms()
    {
        $programs = Booking::query()->whereNotNull('program_id')->get();

        return $this->sendResponse(BookingResource::collection($programs), null);
    }

}
