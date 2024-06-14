<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YourModelName; // Import your model

class YourControllerName extends Controller
{
    // Fetch all records
    public function index()
    {
        $records = YourModelName::all();
        return response()->json($records);
    }

    // Store a new record
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Validation rules here
        ]);

        $record = YourModelName::create($validatedData);
        return response()->json($record, 201);
    }

    // Fetch a single record by ID
    public function show($id)
    {
        $record = YourModelName::findOrFail($id);
        return response()->json($record);
    }

    // Update a record by ID
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            // Validation rules here
        ]);

        $record = YourModelName::findOrFail($id);
        $record->update($validatedData);

        return response()->json($record, 200);
    }

    // Delete a record by ID
    public function destroy($id)
    {
        $record = YourModelName::findOrFail($id);
        $record->delete();

        return response()->json(null, 204);
    }
}
