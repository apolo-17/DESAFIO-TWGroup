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

    public function create()
    {
        return view('CoworkingSpace.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        CoworkingSpace::create($request->all());

        return redirect()->route('dashboard');
    }

    public function edit(CoworkingSpace $coworkingSpace)
    {
        return view('CoworkingSpace.form', ['coworkingSpace' => $coworkingSpace]);
    }

    public function update(CoworkingSpace $coworkingSpace, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $coworkingSpace->update($request->all());
        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        // Encuentra el espacio de coworking por su ID
        $coworkingSpace = CoworkingSpace::findOrFail($id);

        // Elimina el espacio de coworking
        $coworkingSpace->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('dashboard');
    }
}
