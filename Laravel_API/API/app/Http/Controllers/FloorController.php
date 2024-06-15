<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index()
    {
        return Floor::all(['id', 'home_id', 'name']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'home_id' => 'required|exists:homes,id', // Ensure home_id is valid
        ]);

        $floor = Floor::create($validated);
        return response()->json($floor->only(['id', 'home_id', 'name']), 201);
    }

    public function show(Floor $floor)
    {
        return $floor->only(['id', 'home_id', 'name']);
    }

    public function update(Request $request, Floor $floor)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'home_id' => 'sometimes|exists:homes,id', // Ensure home_id is valid
        ]);

        $floor->update($validated);
        return response()->json($floor->only(['id', 'home_id', 'name']), 200);
    }

    public function destroy(Floor $floor)
    {
        $floor->delete();
        return response()->json(null, 204);
    }
}
