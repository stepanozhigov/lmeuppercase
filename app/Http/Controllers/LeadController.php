<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        return response()->json($request);
    }
}
