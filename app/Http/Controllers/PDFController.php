<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Application;
use App\Models\Dormitory;
use App\Models\User;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    //

    public function showInterview($dormId)
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
            ])->groupBy('student_id', 'a.id')->orderBy('sum_score', 'desc')->get();

        foreach ($apps as $app) {
            $user = User::find($app->student_id);
            $sumCredit = Activity::where('year', $year->year)->where('dorm_id', $user->dorm->dormitory->id)->sum('credit');
            $sumUserCredit = DB::table('activity_credits')
                ->join('activities', 'activity_credits.activity_id', '=', 'activities.id')
                ->where('activity_credits.student_id', $user->id)
                ->sum('activities.credit');
            if ($sumCredit == 0) {
                $percent = 0;
            } else {
                $percent = round($sumUserCredit / $sumCredit * 100, 2);
            }
            $arr = array(
                'username' => $user->username,
                'name' => $user->prefix->name.$user->name,
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

        //$dompdf = new PDF();
        //$dompdf->set_paper('a4', 'landscape');

        //dd($dompdf);

        $pdf = PDF::loadView('report.interview.pdf', compact('dorm', 'year', 'data', 'apps'));
        // $pdf = PDF::loadView('report.interview.pdf', compact('dorm', 'year', 'data', 'apps'))->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return view('report.interview.index', compact('dorm', 'year', 'data', 'apps'));
    }

    public function showValidate($id)
    {
        $year = YearConfig::find(1);
        $dorm = Dormitory::find($id);
        $apps = Application::where([
            ['year', $year->year],
            ['dorm_id', $id]
        ])->get();
        $pdf = PDF::loadView('application.pdf', compact('apps', 'dorm', 'year'));
        return $pdf->stream();
        //return view('application.pdf', compact('apps', 'dorm', 'year'));
    }

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
                'room' => $user->dorm->room->name,
                'faculty' => $user->faculty->name,
                'enroll' => $user->enrolled_year,
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
