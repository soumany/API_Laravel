<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;

class CombinedDataController extends Controller
{
    public function fetchData()
    {
        // Retrieve data from models
        $homes = Home::all();
        $floors = Floor::all();
        $rooms = Room::all();

        // Prepare combined data structure
        $combined_data = [
            'homes' => $homes,
            'floors' => $floors,
            'rooms' => $rooms,
        ];

        // Return combined data as JSON response
        return response()->json($combined_data);
    }
}
