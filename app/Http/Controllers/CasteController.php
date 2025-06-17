<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caste;

class CasteController extends Controller
{
    public function byReligion(Request $request)
    {
        $religionId = $request->get('religion_id');
        $castes = Caste::where('religion_id', $religionId)->pluck('name', 'id');
        return response()->json($castes);
    }
}
