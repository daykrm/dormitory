<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use App\Models\DormitoryDetail;
use Illuminate\Http\Request;

class DormitoryDetailController extends Controller
{
    //
    public function getRoom($id)
    {
        $rooms = Dormitory::find($id)->rooms;
        return response()->json(['rooms' => $rooms]);
    }

    public function store(Request $request)
    {
        $rooms = $request->get('rooms');
        $id = $request->input('dorm');
        foreach ($rooms as $val) {
            $data = DormitoryDetail::firstOrNew([
                'dormitory_id' => $id,
                'room_id' => $val
            ]);
            $data->dormitory_id = $id;
            $data->room_id = $val;
            $data->save();
        }
        return back()->with('status', 'เพิ่มห้องพักสำเร็จ');
    }
}
