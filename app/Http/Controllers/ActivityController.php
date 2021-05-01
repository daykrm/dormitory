<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Dormitory;
use App\Models\YearConfig;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $year = YearConfig::find(1);
        $activities = Activity::where('year', $year->year)->orderBy('activity_date')->get();

        //dd(date('Y-m-d'));
        //$sql = Activity::where('activity_date', '>=', date('yyyy-mm-dd'))->orderBy('activity_date')->toSql();
        return view('activity.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('activity.create', [
            'actionRoute' => 'activity.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return back()->with('status','council_id'.$request->input('council_id'));
        //
        $rules = [
            'name' => 'required|string',
            'detail' => 'required|string',
            'year' => 'required|string|min:4|max:4',
            'budget' => 'required',
            'date' => 'required',
            'score' => 'required',
        ];

        $messages = [
            'name.required' => 'กรุณาระบุชื่อกิจกรรม',
            'detail.required' => 'กรุณาระบุรายละเอียดกิจกรรม',
            'year.required' => 'กรุณาระบุปีการศึกษา',
            'budget.required' => 'กรุณาระบุงบประมาณ',
            'date.required' => 'กรุณาระบุวันที่จัดกิจกรรม',
            'score.required' => 'กรุณาระบุคะแนนของกิจกรรม',
        ];

        $request->validate($rules, $messages);

        $table  = new Activity();

        $dorm_id = $request->input('dorm_id');

        $table->name = $request->get('name');
        $table->detail = $request->get('detail');
        $table->year = $request->get('year');
        $table->budget = $request->get('budget');
        $table->activity_date = $request->get('date');
        $table->credit = $request->get('score');
        $table->dorm_id = $dorm_id;

        if ($table->save()) {
            return redirect()->action([ActivityController::class, 'show'], ['activity' => $dorm_id])->with('status', 'บันทึกข้อมูลสำเร็จ');
        } else {
            return back()->with('error', 'บันทึกข้อมูลล้มเหลว');
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
        $activities = Activity::where('year', $year->year)->where('dorm_id', $id)->orderBy('activity_date')->get();
        $dorm_id = $id;

        //dd(date('Y-m-d'));
        //$sql = Activity::where('activity_date', '>=', date('yyyy-mm-dd'))->orderBy('activity_date')->toSql();
        return view('activity.index', compact('activities','dorm_id'));
    }

    public function adminIndex()
    {
        $dorms = Dormitory::all();
        return view('activity.select', compact('dorms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        $dorm_id = $activity->dorm_id;
        return view('activity.edit', [
            'activity' => $activity,
            'dorm_id' => $dorm_id
        ]);
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
        $rules = [
            'name' => 'required|string',
            'detail' => 'required|string',
            'year' => 'required|string|min:4|max:4',
            'budget' => 'required',
            'date' => 'required',
            'score' => 'required',
        ];

        $messages = [
            'name.required' => 'กรุณาระบุชื่อกิจกรรม',
            'detail.required' => 'กรุณาระบุรายละเอียดกิจกรรม',
            'year.required' => 'กรุณาระบุปีการศึกษา',
            'budget.required' => 'กรุณาระบุงบประมาณ',
            'date.required' => 'กรุณาระบุวันที่จัดกิจกรรม',
            'score.required' => 'กรุณาระบุคะแนนของกิจกรรม',
        ];

        $request->validate($rules, $messages);

        // dd($request);

        $table  = Activity::find($id);

        $dorm_id = $request->input('dorm_id');

        $table->name = $request->get('name');
        $table->detail = $request->get('detail');
        $table->year = $request->get('year');
        $table->budget = $request->get('budget');
        $table->activity_date = $request->get('date');
        $table->credit = $request->get('score');
        $table->dorm_id = $dorm_id;

        if ($table->save()) {
            return redirect()->action([ActivityController::class, 'show'], ['activity' => $dorm_id])->with('status', 'บันทึกข้อมูลสำเร็จ');
        } else {
            return back()->with('error', 'บันทึกข้อมูลล้มเหลว');
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
