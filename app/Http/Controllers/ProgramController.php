<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Booking;
use App\Models\Program;
use App\Service\PayPalPaymentService;
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
        $data['type'] = 'Program';
        $data['id'] = $booking->id;


        if($request->input('payment_type') =='paypal'){
            $redirectUrl = (new PayPalPaymentService())->pay($data);
            $redirectData['url'] = $redirectUrl;
        }else{
            $redirectUrl =  (new TapPaymentService())->pay($data);
            $redirectData['url'] = $redirectUrl;
        }
        return $this->sendResponse($redirectData, 'استخدم هذا الرابط لتحويل المستخدم لبوابه الدفع');
    }

    public function show(Program $program)
    {
       return  $this->sendResponse(ProgramResource::make($program), null);
    }
}
