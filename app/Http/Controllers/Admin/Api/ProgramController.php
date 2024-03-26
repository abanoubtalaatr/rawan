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
        $validatedData = $request->validated();

        // Upload the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Create the program with the uploaded image
        $program = Program::create($validatedData);

        // Return the response with the resource including the uploaded image
        return $this->sendResponse(ProgramResource::make($program), trans("تمت الاضافة"));
    }


    public function update(ProgramRequest $request, Program $program)
    {
        // Update the program data
        $program->update($request->validated());

        // Upload the image if it exists in the request
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Update the program's image field with the new image name
            $program->image = $imageName;
            $program->save();
        }

        // Return the updated resource
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
        $request->validate(['level' => 'required', 'life_style' => 'required']);

        $level = $request->input('level');
        $life_style = $request->input('life_style');

        $program = null;

        if ($level == 1) {
            if ($life_style == 3) {
                $program = Program::query()
                    ->where('number_of_days', 4)
                    ->first();
            } elseif ($life_style == 2 || $life_style == 1) {
                $program = Program::query()
                    ->where('number_of_days', 3)
                    ->first();
            }
        } elseif ($level == 2) {
            if ($life_style == 3) {
                $program = Program::query()
                    ->where('number_of_days', 4)
                    ->first();
            } elseif ($life_style == 2) {
                $program = Program::query()
                    ->where('number_of_days', 4)
                    ->first();
            } elseif ($life_style == 1) {
                $program = Program::query()
                    ->where('number_of_days', 3)
                    ->first();
            }
        } elseif ($level == 3) {
            if ($life_style == 3) {
                $program = Program::query()
                    ->where('number_of_days', 4)
                    ->first();
            } elseif ($life_style == 2 || $life_style == 1) {
                $program = Program::query()
                    ->where('number_of_days', 5)
                    ->first();
            }
        }

        if ($program) {
            return $this->sendResponse(ProgramResource::make($program), null);
        } else {
            // Handle the case when no program matches the given criteria
            return $this->sendError('No program found for the given criteria.', [], 404);
        }
    }

}
