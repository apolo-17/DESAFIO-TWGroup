<?php

namespace App\Http\Controllers;

use App\Models\CoworkingSpace;
use Illuminate\Http\Request;

class CoworkingSpaceController extends Controller
{
    public function index()
    {
        $spaces = CoworkingSpace::all();
        return view('coworking-spaces.index', compact('spaces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        CoworkingSpace::create($request->all());

        return redirect()->route('coworking-spaces.index');
    }
}
