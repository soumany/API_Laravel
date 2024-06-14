<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        return Building::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $building = Building::create($validated);
        return response()->json($building, 201);
    }

    public function show(Building $building)
    {
        return $building;
    }

    public function update(Request $request, Building $building)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
        ]);

        $building->update($validated);
        return response()->json($building, 200);
    }

    public function destroy(Building $building)
    {
        $building->delete();
        return response()->json(null, 204);
    }
}
