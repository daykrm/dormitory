<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use App\Models\DormitoryDetail;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dorm.room.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $room = new Room();

        $name = $request->get('name');

        $room = Room::firstOrNew(['name' => $name]);

        $room->name = $name;

        if ($room->save()) {
            return back()->with('status', 'เพิ่มห้องใหม่สำเร็จ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $dorm = Dormitory::find($id);
        $rooms = $dorm->rooms;
        $in_room = [];
        foreach ($rooms as $item) {
            $in_room[] = $item->id;
        }
        $allRooms = Room::all();
        $availableRoom = Room::whereNotIn('id', $in_room)->get();
        return view('dorm.room.index', compact('dorm', 'rooms', 'availableRoom', 'allRooms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
