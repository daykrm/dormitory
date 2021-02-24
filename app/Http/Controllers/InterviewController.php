<?php

namespace App\Http\Controllers;

use App\Models\Activity;
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
        return view('interview.index');
    }

    public function findStudent(Request $request)
    {
        $year = YearConfig::find(1);
        $user = User::where('username', $request->get('username'))->first();

        if ($user == null) {
            return back()->with('error', 'ไม่พับนักศึกษา');
        }

        $application = DB::table('applications')->where([
            ['student_id', $user->id],
            ['year', $year->year]
        ])->first();

        if ($application == null) {
            return back()->with('error', 'ไม่พบใบสมัคร');
        }

        $appId = $application->id;

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
            ->with('dorm_score', $dorm_score);
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
