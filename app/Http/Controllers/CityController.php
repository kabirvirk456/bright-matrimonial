<?php
// app/Http/Controllers/CityController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function byState(Request $request)
{
    $stateId = $request->get('state_id');
    if (!$stateId) {
        return response()->json([], 400); // Missing state_id
    }

    // Make sure your City model and migration has 'state_id' column!
    $cities = \App\Models\City::where('state_id', $stateId)->pluck('name', 'id');
    return response()->json($cities);
}

}
