<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use Illuminate\Http\Request;

class DormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dorms = Dormitory::all()->sortBy('name');
        return view('dorm.index', compact('dorms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dorm.create');
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
        $dorm = new Dormitory();
        $dorm->name = $request->get('name');
        if ($dorm->save()) {
            return redirect()->action([DormController::class, 'index'])->with('status', 'เพิ่มข้อมูลสำเร็จ');
        }
        return back()->with('error', 'เพิ่มข้อมูลล้มเหลว');
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
        $dorm = Dormitory::find($id);
        return view('dorm.edit', compact('dorm'));
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
        $dorm = Dormitory::find($id);
        $dorm->name = $request->get('name');
        if ($dorm->save()) {
            return redirect()->action([DormController::class, 'index'])->with('status', 'แก้ไขข้อมูลสำเร็จ');
        }
        return back()->with('error', 'แก้ไขข้อมูลล้มเหลว');
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
