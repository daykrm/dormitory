<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Dormitory;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dorms = Dormitory::all();
        return view('report.validate.select', compact('dorms'));
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
        $id = $request->input('dorm');
        $dorm = Dormitory::find($id);
        $pdf = $request->file('file');
        $year = YearConfig::find(1);
        $path = $pdf->storeAs('file/' . $year->year, 'validate_' . $dorm->name . '.pdf');
        $old = DB::table('report_result')->where([['year', $year->year], ['dormitory_id', $id], ['status', 0]])->first();
        if ($old != null) {
            DB::table('report_result')->where('id', $old->id)->update(['path' => $path]);
        } else {
            DB::table('report_result')->insert([
                'year' => $year->year,
                'dormitory_id' => $id,
                'path' => $path,
                'status' => 0
            ]);
        }
        return redirect()->action([ValidateController::class, 'show'], ['validate' => $id])->with('status', 'อัพโหลดไฟล์สำเร็จ');
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
        # code...
        $year = YearConfig::find(1);
        $dorm = Dormitory::find($id);
        $file = DB::table('report_result')->where('year', $year->year)->where('status', 0)->where('dormitory_id', $id)->first();
        //dd($file);
        return view('report.validate.index', compact('year', 'file', 'dorm'));
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