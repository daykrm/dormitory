<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\YearConfig;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $year = YearConfig::find(1);
        $activities = Activity::where('year', $year->year)->orderBy('name', 'DESC')->orderBy('activity_date', 'ASC')->get();
        return view('report.activity.index', compact('activities', 'year'));
    }

    public function show($userId)
    {
        $year = YearConfig::find(1);
        $activities = Activity::where('year', $year->year)->orderBy('name', 'DESC')->orderBy('activity_date', 'ASC')->get();
        $sumCredit = $activities->sum('credit'); //คะแนนรวมทั้งปี
        //dd($sumCredit);
        return view('report.activity.show', compact('year', 'activities'));
    }

    public function search($start, $end)
    {
        $year = YearConfig::find(1);
        $activities = Activity::whereBetween('year', [$start, $end])->orderBy('name')->orderBy('activity_date')->get();
        return view('report.activity.index', compact('activities', 'year'));
    }
}
