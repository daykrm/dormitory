<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Dormitory;
use App\Models\Personel;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $file = DB::table('report_result')->where('year', $year->year)->where('dormitory_id', $dormId)->where('status',1)->first();
        //dd($file);
        return view('report.result.index', compact('year', 'file'));
    }

    public function show(Request $request)
    {
        $id = $request->get('dorm');
        $model = Dormitory::find($id);
        $dorm = $model->name;
        $year = YearConfig::find(1);
        $file = DB::table('report_result')->where('year', $year->year)->where('dormitory_id', $id)->where('status', 1)->first();
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
        $path = 'dormitory/file/'.$year->year.'/'.$dorm.'.pdf';
        Storage::disk('s3')->put($path, file_get_contents($pdf), 'public-read');
        // $path = $pdf->storeAs('file/' . $year->year, $dorm . '.pdf');
        $old = DB::table('report_result')->where([['year', $year->year], ['dormitory_id', $id], ['status', 1]])->first();
        if ($old != null) {
            DB::table('report_result')->where('id', $old->id)->update(['path' => $path]);
        } else {
            DB::table('report_result')->insert([
                'year' => $year->year,
                'dormitory_id' => $id,
                'path' => $path
            ]);
        }
        $file = DB::table('report_result')->where('year', $year->year)->where('dormitory_id', $id)->where('status',1)->first();
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

    public function edit($id)
    {
        $year = YearConfig::find(1);
        $dorm = Personel::find($id)->dorms;
        return view('report.result.select', compact('year', 'dorm'));
    }
}
