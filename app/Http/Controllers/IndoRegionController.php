<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilities\District;
use App\Models\Utilities\Village;

class IndoRegionController extends Controller
{
    public function getDistricts($id)
    {
        $districts = District::where('regency_id', $id)->get();
        return response()->json($districts);
    }

    public function getVillages($id)
    {
        $villages = Village::where('district_id', $id)->get();
        return response()->json($villages);
    }
}
