<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($dormId)
    {
        # code...
        $year = YearConfig::find(1);
        $file = DB::table('report_result')->where('year', $year->year)->where('dormitory_id', $dormId)->first();
        //dd($file);
        return view('report.result.index', compact('year', 'file'));
    }
}
