<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Api\OpinionRequest;
use App\Http\Resources\Admin\Api\OpinionResource;
use App\Models\Opinion;

class OpinionController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(OpinionResource::collection(Opinion::query()->get()), null, 200);
    }

    public function store(OpinionRequest $request)
    {
        $data = Opinion::query()->create($request->validated());

        return $this->sendResponse($data, trans("تمت الاضافة"));
    }

    public function update(OpinionRequest $request, Opinion $opinion)
    {
        $opinion->update($request->validated());
        return $this->sendResponse($opinion->refresh(), trans("الاجراء تم بنجاح"));
    }

    public function show(Opinion $opinion)
    {
        return $this->sendResponse($opinion, "تم الاجراء بنجاح");
    }

    public function destroy(Opinion $opinion)
    {
        $opinion->delete();
        return $this->sendResponse(null, "الاجراء تم بنجاح");
    }

}
