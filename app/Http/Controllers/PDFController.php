<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Dormitory;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    //

    public function showDormActivities($dormId)
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
                    ->where('a.id', $item->id)
                    ->where('ac.student_id', $user->id)->first();
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
            if ($sumCredit == 0) {
                $percent = 0;
            } else {
                $percent = round($sumUserCredit / $sumCredit * 100, 2);
            }
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
        //dd($data);
        $sum_score = array_column($data, 'sum_score');
        array_multisort($sum_score, SORT_DESC, $data);
        $pdf = PDF::loadView('report.activity.pdf', ['dorm' => $dorm, 'data' => $data, 'year' => $year, 'sumCredit' => $sumCredit]);
        // $pdf->set_base_path(storage_path());
        // dd(storage_path());
        return $pdf->stream();
    }
}