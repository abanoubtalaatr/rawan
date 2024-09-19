<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $row = Visitor::first();
        return response()->json([
            'data' => $row? $row->number : 0
        ]);
    }

    public function store(Request $request)
    {
        $row = Visitor::first();
        if ($row) {
            $row->number += 1;
            $row->save();
        } else {
           $row = Visitor::create([
                'number' => 1
            ]);
        }
        return response()->json(['data' => $row->number]);
    }
}
