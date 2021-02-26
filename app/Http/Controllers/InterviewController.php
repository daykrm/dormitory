<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Dormitory;
use App\Models\Faculty;
use App\Models\Interview_score;
use App\Models\User;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('isLogin');
    }

    public function index()
    {
        //
        $year = YearConfig::find(1);
        $returnArr = [];
        $apps = DB::table('applications as a')
            ->select(
                'a.student_id as student_id',
                'a.id as id',
                DB::raw('AVG(is.dorm_score) as dorm_score'),
                DB::raw('AVG(is.family_score) as family_score'),
                DB::raw('AVG(is.behavior_score) as behavior_score'),
                DB::raw('AVG(is.kku_score) as kku_score'),
                DB::raw('(dorm_score + family_score + behavior_score + kku_score) as sum_score'),
                DB::raw('COUNT(is.id) as count'),
            )
            ->leftJoin('interview_scores as is', 'is.application_id', '=', 'a.id')
            ->where([
                ['a.year', $year->year],
                ['a.status', 0],
            ])->groupBy('student_id', 'a.id')->orderBy('sum_score','desc')->simplePaginate(5);

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
                'id' => $app->id
            );

            array_push($returnArr, $arr);
        }

        //dd($returnArr);
        // $applications = DB::table('applications as a')
        //     ->select(
        //         'u.username as username',
        //         'u.name as name',
        //         'f.name as faculty',
        //         DB::raw(''),
        //         DB::raw('SUM(is.dorm_score) as dorm_score'),
        //         DB::raw('SUM(is.family_score) as family_score'),
        //         DB::raw('SUM(is.behavior_score) as behavior_score'),
        //         DB::raw('SUM(is.kku_score) as kku_score'),
        //         DB::raw('(dorm_score + family_score + behavior_score + kku_score) as sum_score')
        //     )
        //     ->join('users as u', 'a.student_id', '=', 'u.id')
        //     ->join('faculties as f', 'u.faculty_id', '=', 'f.id')
        //     ->leftJoin('interview_scores as is', 'is.application_id', '=', 'a.id')
        //     ->groupBy('a.id')
        //     ->get();

        //dd($returnArr);
        return view('interview.index', ['data' => $returnArr, 'apps' => $apps]);
    }

    public function calculateResult(Request $request){
        dd($request->get('sum'));
        //loop appId to change application status to 1 (calculated)
        return back()->with('status','ประมวลผลสำเร็จจ้า');
    }

    public function findStudent(Request $request)
    {
        $year = YearConfig::find(1);
        $user = User::where('username', $request->get('username'))->first();
        $personel_id = $request->input('personel_id');

        if ($user == null) {
            return back()->with('error', 'ไม่พับนักศึกษา');
        }

        $application = DB::table('applications')->where([
            ['student_id', $user->id],
            ['year', $year->year],
            ['status', 0]
        ])->first();

        if ($application == null) {
            return back()->with('error', 'ไม่พบใบสมัคร');
        }

        $appId = $application->id;

        $interviewScore = Interview_score::where([
            'application_id' => $appId,
            'personel_id' => $personel_id
        ])->first();

        //dd($interviewScore);

        $sumCredit = Activity::where('year', $year->year)->where('dorm_id', $user->dorm->dormitory->id)->orderBy('name', 'DESC')->orderBy('activity_date', 'ASC')->sum('credit');
        // $activities->sum('credit'); //คะแนนรวมทั้งปี
        $sumUserCredit = DB::table('activity_credits')
            ->join('activities', 'activity_credits.activity_id', '=', 'activities.id')
            ->where('activity_credits.student_id', $user->id)
            ->sum('activities.credit');
        $percent = round($sumUserCredit / $sumCredit * 100, 2);

        $dorm_score = round($percent / 100 * 40, 2);

        return back()->with('user', $user)
            ->with('percent', $percent)
            ->with('appId', $appId)
            ->with('dorm_score', $dorm_score)
            ->with('score', $interviewScore);
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
        $appId = $request->input('app_id');
        $personel_id = $request->input('personel_id');
        $dorm_score = $request->input('dorm_score');
        $kku_score = $request->get('kku_score');
        $family_score = $request->get('family_score');
        $behavior_score = $request->get('behavior_score');

        $interview = DB::table('interview_scores')->where([
            ['application_id', $appId],
        ])->count();

        if ($interview == 2) {
            return back()->with('error', 'ไม่สามารถบันทึกคะแนนได้ เนื่องจากบันทึกใบสมัครครบ 2 ครั้งแล้ว');
        }

        $interview = DB::table('interview_scores')->where([
            ['application_id', $appId],
            ['personel_id', $personel_id]
        ])->count();

        if ($interview == 1) {
            return back()->with('error', 'ไม่สามารถบันทึกคะแนนได้ เนื่องจากเคยบันทึกคะแนนแล้ว');
        }

        $id = DB::table('interview_scores')->insertGetId([
            'application_id' => $appId,
            'personel_id' => $personel_id,
            'dorm_score' => $dorm_score,
            'kku_score' => $kku_score,
            'family_score' => $family_score,
            'behavior_score' => $behavior_score,
        ]);

        if ($id != null) {
            return back()->with('status', 'บันทึกคะแนนสำเร็จ');
        } else {
            return back()->with('error', 'บันทึกคะแนนผิดพลาด');
        }
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
        $year = YearConfig::find(1);
        $dorm = Dormitory::find($id);
        $applications = DB::table('applications as a')
            ->select(
                'u.username as username',
                'u.name as name',
                'f.name as faculty',
                DB::raw('SUM(is.dorm_score) as dorm_score'),
                DB::raw('SUM(is.family_score) as family_score'),
                DB::raw('SUM(is.behavior_score) as behavior_score'),
                DB::raw('SUM(is.kku_score) as kku_score'),
                DB::raw('(dorm_score + family_score + behavior_score + kku_score) as sum_score')
            )
            ->join('users as u', 'a.student_id', '=', 'u.id')
            ->join('faculties as f', 'u.faculty_id', '=', 'f.id')
            ->leftJoin('interview_scores as is', 'is.application_id', '=', 'a.id')
            ->groupBy('a.id')
            ->get();
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
