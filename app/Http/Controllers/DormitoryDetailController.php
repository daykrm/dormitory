<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use Illuminate\Http\Request;

class DormitoryDetailController extends Controller
{
    //
    public function getRoom($id)
    {
        $rooms = Dormitory::find($id)->rooms;
        return response()->json(['rooms' => $rooms]);
    }
}
