<?php

namespace App\Http\Controllers;

use App\Http\Resources\FAQResource;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(FAQResource::collection(FAQ::query()->get()), null);
    }
}
