<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Dormitory;
use App\Models\Personel;
use App\Models\YearConfig;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class ResultController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('isLogin');
    }

    public function index()
    {
        # code...
        $year = YearConfig::find(1);
        $file = DB::table('report_result')->where('year', $year->year)->where('status', 1)->first();
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
        $year = YearConfig::find(1);
        $path = 'dormitory/file/' . $year->year;
        $filename = uniqid() . '.pdf';
        $fullPath = $path . '/' . $filename;

        $config = Config::get('filesystems.disks.s3');

        try {

            $disk = Storage::disk('s3');
            $disk->put($fullPath, \fopen($request->file('file'), 'r+'));

            //return response()->json('Fule upload successfully');

            $old = DB::table('report_result')->where([['year', $year->year], ['status', 1]])->first();
            if ($old != null) {
                DB::table('report_result')->where('id', $old->id)->update(['path' => $fullPath]);
            } else {
                DB::table('report_result')->insert([
                    'year' => $year->year,
                    'path' => $fullPath,
                    'status' => 1
                ]);
            }
            $file = DB::table('report_result')->where('year', $year->year)->where('status', 1)->first();
            return view('report.result.index', compact('year', 'file'));
        } catch (S3Exception $e) {

            echo $e->getAwsRequestId() . '\n';
            echo $e->getAwsErrorType() . '\n';
            echo $e->getAwsErrorCode() . '\n';
        }
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
