<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Activity_credit;
use App\Models\Dormitory;
use App\Models\User;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $year = YearConfig::find(1);
        $activities = Activity::where('year', $year->year)->where('dorm_id', $id)->orderBy('name', 'DESC')->orderBy('activity_date', 'ASC')->get();
        return view('report.activity.index', compact('activities', 'year'));
    }

    public function showAll($dormId)
    {
        $year = YearConfig::find(1);
        $activities = Activity::where('year', $year->year)->where('dorm_id', $dormId)->orderBy('name', 'DESC')->orderBy('activity_date', 'ASC')->get();
        $sumCredit = Activity::where('year', $year->year)->where('dorm_id', $dormId)->orderBy('name', 'DESC')->orderBy('activity_date', 'ASC')->sum('credit');
        $dorm = Dormitory::find($dormId);
        $users = Dormitory::find($dormId)->users->where('type_id', '<>', 3);
        $data = [];
        foreach ($users as $user) {
            $score = [];
            foreach ($activities as $item) {
                $array = array(
                    'name' => $item->name,
                    'score' => 0
                );
                $credit = DB::table('activity_credits as ac')
                    ->select('a.credit')
                    ->join('activities as a', 'ac.activity_id', '=', 'a.id')
                    ->where('a.id', $item->id)->first();
                if ($credit != null) {
                    $array['score'] = $credit->credit;
                }
                array_push($score, $array);
            }
            $sumUserCredit = DB::table('activity_credits')
                ->join('activities', 'activity_credits.activity_id', '=', 'activities.id')
                ->where('activity_credits.student_id', $user->id)
                ->where('activities.year', $year->year)
                ->sum('activities.credit');
            $percent = round($sumUserCredit / $sumCredit * 100, 2);
            $arr = array(
                'username' => $user->username,
                'name' => $user->name,
                'prefix' => $user->prefix->name,
                'sum_score' => $sumUserCredit,
                'percent' => $percent,
                'activities' => $score,
            );
            array_push($data, $arr);
        }
        $sum_score = array_column($data, 'sum_score');
        array_multisort($sum_score, SORT_DESC, $data);
        return view('report.activity.showAll', compact('dorm', 'data', 'year','sumCredit'));
    }

    public function show($userId, $dormId)
    {
        $year = YearConfig::find(1);
        //$activities = Activity::where('year', $year->year)->orderBy('name', 'DESC')->orderBy('activity_date', 'ASC')->get();
        $sumCredit = Activity::where('year', $year->year)->where('dorm_id', $dormId)->orderBy('name', 'DESC')->orderBy('activity_date', 'ASC')->sum('credit');
        // $activities->sum('credit'); //คะแนนรวมทั้งปี
        $sumUserCredit = DB::table('activity_credits')
            ->join('activities', 'activity_credits.activity_id', '=', 'activities.id')
            ->where('activity_credits.student_id', $userId)
            ->where('activities.year', $year->year)
            ->sum('activities.credit');
        $activity_credit = DB::table('activity_credits as ac')
            ->select('a.name as name', 'a.activity_date as date', 'a.credit as credit', 'ac.created_at as date_create')
            ->join('activities as a', 'ac.activity_id', '=', 'a.id')
            ->where([
                ['ac.student_id', $userId],
                ['a.year', $year->year]
            ])->get();
        $percent = round($sumUserCredit / $sumCredit * 100, 2);
        //var_dump($sumCredit);
        //var_dump($sumUserCredit);
        return view('report.activity.show', compact('year', 'sumCredit', 'activity_credit', 'percent', 'sumUserCredit'));
    }

    public function search($dormId, $start, $end)
    {
        $year = YearConfig::find(1);
        $activities = Activity::whereBetween('year', [$start, $end])->where('dorm_id', $dormId)->orderBy('name')->orderBy('activity_date')->get();
        return view('report.activity.index', compact('activities', 'year'));
    }
}
