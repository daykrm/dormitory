<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Application;
use App\Models\Dormitory;
use App\Models\Faculty;
use App\Models\Interview_score;
use App\Models\Personel;
use App\Models\Result;
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
        $dorms = Dormitory::all();
        return view('interview.select', compact('dorms'));
    }

    public function calculateResult(Request $request)
    {
        //dd($request->get('sum'));
        $appId = $request->get('app');
        //$available = $request->get('available');
        //loop appId to change application status to 1 (calculated)
        for ($i = 0; $i < count($appId); $i++) {
            $apps = Application::find($appId[$i]);
            $dorm = Dormitory::find($apps->dorm_id);
            $available = count($dorm->rooms);
            if ($i < $available) {
                $status = 1;
            } else {
                $status = 0;
            }
            DB::table('results')->insert([
                'application_id' => $appId[$i],
                'status' => $status,
            ]);
            DB::table('applications')->where('id', $appId[$i])->update(['status' => 1]);
        }
        return back()->with('status', 'ประมวลผลสำเร็จจ้า');
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
        if ($sumCredit == 0) {
            $percent = 0;
        } else {
            $percent = round($sumUserCredit / $sumCredit * 100, 2);
        }

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
    public function show($dormId)
    {
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

        $dorms = Dormitory::all();
        $dorm = Dormitory::find($dormId);

        return view('interview.index', ['year' => $year, 'data' => $returnArr, 'apps' => $apps, 'dorms' => $dorms, 'dorm' => $dorm]);
    }

    public function changeStatus($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dorms = Personel::find($id)->dorms;
        return view('interview.select', compact('dorms'));
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
        $result = Result::find($id);
        if ($result->status == 1) {
            $result->status = 0;
        } else {
            $result->status = 1;
        }
        if ($result->save()) {
            return back()->with('status', 'แก้ไขสถานะสำเร็จ');
        } else {
            return back()->with('error', 'แก้ไขสถานะล้มเหลว');
        }
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
