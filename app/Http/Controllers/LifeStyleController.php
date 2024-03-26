<?php

namespace App\Http\Controllers;

use App\Http\Resources\LifeStyleResource;
use App\Models\LifeStyle;
use Illuminate\Http\Request;

class LifeStyleController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(LifeStyleResource::collection(LifeStyle::all()), null);
    }
}
