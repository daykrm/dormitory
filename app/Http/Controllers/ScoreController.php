<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Activity_credit;
use App\Models\User;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $year = YearConfig::find(1);
        $activities = Activity::where('year', $year->year)->where('dorm_id', $id)->orderBy('name')->get();
        return view('score.index', compact('activities', 'year'));
    }

    public function store(Request $request)
    {
        $student_id = $request->input('user_id');
        $activity_id = $request->input('activity_id');

        $id = DB::table('activity_credits')->where([
            ['student_id', $student_id],
            ['activity_id', $activity_id]
        ])->first();

        if ($id != null) return back()->with('status', 'บันทึกข้อมูลสำเร็จ');

        $table = new Activity_credit();

        $table->student_id = $request->input('user_id');
        $table->activity_id = $request->input('activity_id');
        if ($table->save()) {
            return back()->with('status', 'บันทึกข้อมูลสำเร็จ');
        } else {
            return back()->with('error', 'บันทึกข้อมูลล้มเหลว');
        }
    }

    public function showForm($id)
    {
        $activity = Activity::find($id);
        $data = Activity_credit::where('activity_id', $id)->get();
        return view('score.create', compact('activity', 'data'));
    }

    public function findStudent(Request $request)
    {
        $user = User::where('username', $request->get('username'))->first();
        if ($user != null) {
            $userDorm = $user->dorm->dormitory->id;
            $dorm = $request->input('dorm');
            if ($dorm != $userDorm) {
                return back()->with('error', 'ไม่พบนักศึกษาในหอพักนี้');
            }
            return back()->with('user', $user);
        } else {
            return back()->with('error', 'ไม่พบนักศึกษา');
        }
    }
}
