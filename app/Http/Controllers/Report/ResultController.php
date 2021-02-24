<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Dormitory;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('isLogin');
    }

    public function index($dormId)
    {
        # code...
        $year = YearConfig::find(1);
        $file = DB::table('report_result')->where('year', $year->year)->where('dormitory_id', $dormId)->first();
        //dd($file);
        return view('report.result.index', compact('year', 'file'));
    }

    public function show(Request $request)
    {
        $id = $request->get('dorm');
        $model = Dormitory::find($id);
        $dorm = $model->name;
        $year = YearConfig::find(1);
        $file = DB::table('report_result')->where('year', $year->year)->where('dormitory_id', $id)->first();
        return view('report.result.index', compact('year', 'file', 'dorm', 'id'));
    }

    public function store(Request $request)
    {
        //dd($request->hasFile('file'));
        $id = $request->input('dorm');
        $year = YearConfig::find(1);
        $model = Dormitory::find($id);
        $dorm = $model->name;
        $pdf = $request->file('file');
        $path = $pdf->storeAs('file/' . $year->year, $dorm . '.pdf');
        DB::table('report_result')->insert([
            'year' => $year->year,
            'dormitory_id' => $id,
            'path' => $path
        ]);
        $file = DB::table('report_result')->where('year', $year->year)->where('dormitory_id', $id)->first();
        return view('report.result.index', compact('year', 'file', 'dorm', 'id'));
        //return redirect()->action([ResultController::class, 'index'], ['id' => $request->input('dorm')]);
        //return back()->withInput()->with('status', 'อัพโหลดไฟล์สำเร็จ');
    }

    public function select()
    {
        $year = YearConfig::find(1);
        $dorm = Dormitory::all();
        return view('report.result.select', compact('year', 'dorm'));
    }
}
