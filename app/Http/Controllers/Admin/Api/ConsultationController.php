<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Api\ConsultationRequest;
use App\Http\Resources\Admin\Api\ConsultationResource;
use App\Models\Consultation;
use App\Service\TapPaymentService;

class ConsultationController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(ConsultationResource::collection(Consultation::query()->get()), null, 200);
    }

    public function store(ConsultationRequest $request)
    {
        $data = Consultation::query()->create($request->validated());

        return $this->sendResponse($data, trans("تمت الاضافة"));
    }

    public function update(ConsultationRequest $request, Consultation $consultation)
    {
        $consultation->update($request->validated());
        return $this->sendResponse($consultation->refresh(), trans("الاجراء تم بنجاح"));
    }

    public function show(Consultation $consultation)
    {
        return $this->sendResponse($consultation, "تم الاجراء بنجاح");
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return $this->sendResponse(null, "الاجراء تم بنجاح");
    }
}
