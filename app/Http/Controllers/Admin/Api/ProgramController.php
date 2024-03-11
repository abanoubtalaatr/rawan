<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(ProgramResource::collection(Program::query()->get()), null, 200);
    }

    public function store(ProgramRequest $request)
    {
        $data = Program::query()->create($request->validated());

        return $this->sendResponse(ProgramResource::make($data), trans("تمت الاضافة"));
    }

    public function update(ProgramRequest $request, Program $program)
    {
        $program->update($request->validated());
        return $this->sendResponse(ProgramResource::make($program->refresh()), trans("الاجراء تم بنجاح"));
    }

    public function show(Program $program)
    {
        return $this->sendResponse(ProgramResource::make($program), "تم الاجراء بنجاح");
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return $this->sendResponse(null, "الاجراء تم بنجاح");
    }

    public function randomProgram(Request $request)
    {
        $request->validate(['weight' => 'required', 'height' => 'required']);

        $weight = $request->input('weight');
        $height = $request->input('height');

        $program = Program::query()
            ->where('height', '>=', $height)
            ->orWhere('height', '<=', $height)
            ->orWhere('weight', '>=', $weight)
            ->orWhere('weight', '<=', $weight)
            ->first();

        return $this->sendResponse(ProgramResource::make($program), null);
    }
}
