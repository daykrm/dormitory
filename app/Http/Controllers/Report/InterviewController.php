<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Dormitory;
use App\Models\Result;
use App\Models\User;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('isLogin');
    }

    public function index()
    {
        $dorms = Dormitory::all();
        return view('report.interview.select', compact('dorms'));
    }

    public function show($dormId)
    {
        $dorm = Dormitory::find($dormId);
        $year = YearConfig::find(1);
        $data = [];
        $apps = DB::table('results as r')
            ->select(
                'a.student_id as student_id',
                'a.id as id',
                DB::raw('AVG(is.dorm_score) as dorm_score'),
                DB::raw('AVG(is.family_score) as family_score'),
                DB::raw('AVG(is.behavior_score) as behavior_score'),
                DB::raw('AVG(is.kku_score) as kku_score'),
                DB::raw('(dorm_score + family_score + behavior_score + kku_score) as sum_score'),
                DB::raw('COUNT(is.id) as count'),
                'r.status as status',
                'r.id as resultId',
            )
            ->leftJoin('applications as a', 'r.application_id', '=', 'a.id')
            ->leftJoin('interview_scores as is', 'is.application_id', '=', 'a.id')
            ->where([
                ['a.year', $year->year],
                ['a.dorm_id', $dormId]
            ])->groupBy('student_id', 'a.id')->orderBy('sum_score', 'desc')->simplePaginate(5);

        foreach ($apps as $app) {
            $user = User::find($app->student_id);
            $sumCredit = Activity::where('year', $year->year)->where('dorm_id', $user->dorm->dormitory->id)->sum('credit');
            $sumUserCredit = DB::table('activity_credits')
                ->join('activities', 'activity_credits.activity_id', '=', 'activities.id')
                ->where('activity_credits.student_id', $user->id)
                ->sum('activities.credit');
            $percent = round($sumUserCredit / $sumCredit * 100, 2);
            $arr = array(
                'username' => $user->username,
                'name' => $user->name,
                'faculty' => $user->faculty->name,
                'percent' => $percent,
                'credit' => $user->credit,
                'dorm_score' => $app->dorm_score,
                'kku_score' => $app->kku_score,
                'behavior_score' => $app->behavior_score,
                'family_score' => $app->family_score,
                'sum_score' => $app->sum_score,
                'count' => $app->count,
                'id' => $app->id,
                'status' => $app->status,
                'resultId' => $app->resultId
            );

            array_push($data, $arr);
        }
        return view('report.interview.index', compact('dorm', 'year', 'data', 'apps'));
    }
}
