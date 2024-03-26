<?php

namespace App\Http\Controllers;

use App\Http\Resources\LevelResource;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(LevelResource::collection(Level::all()), null);
    }
}
