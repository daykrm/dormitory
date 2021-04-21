<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceListController extends Controller
{
    //
    public function index()
    {
        $provinces = Province::all();
        return view('test.index', compact('provinces'));
    }

    public function getDistrict($province_id)
    {
        $districts = Province::find($province_id)->districts;
        return response()->json(
            $districts
        );
    }

    public function getSubDistrict($district_id)
    {
        $data = District::find($district_id)->subdistricts;
        return response()->json($data);
    }
}
