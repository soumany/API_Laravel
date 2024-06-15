<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return Home::all(['id', 'home_location', 'owner']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_location' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
        ]);

        $home = Home::create($validated);
        return response()->json($home, 201);
    }

    public function show(Home $home)
    {
        return $home;
    }

    public function update(Request $request, Home $home)
    {
        $validated = $request->validate([
            'home_location' => 'sometimes|string|max:255',
            'owner' => 'sometimes|string|max:255',
        ]);

        $home->update($validated);
        return response()->json($home, 200);
    }

    public function destroy(Home $home)
    {
        $home->delete();
        return response()->json(null, 204);
    }
}
