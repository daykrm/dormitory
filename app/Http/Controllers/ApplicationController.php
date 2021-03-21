<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Dormitory;
use App\Models\Faculty;
use App\Models\Interview_score;
use App\Models\Occupation;
use App\Models\Prefix;
use App\Models\Province;
use App\Models\Result;
use App\Models\YearConfig;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApplicationController extends Controller
{

    public function __construct()
    {
        $this->middleware('isLogin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dorms = Dormitory::all();
        return view('application.select', compact('dorms'));
    }

    public function showAll($id)
    {
        $year = YearConfig::find(1);
        $dorm = Dormitory::find($id);
        $apps = Application::where([
            ['year', $year->year],
            ['dorm_id', $id]
        ])->get();
        return view('application.showall', compact('apps', 'dorm'));
    }

    public function checkApplicationThisYear($userId)
    {
        $year = YearConfig::find(1);
        $appData = Application::where('student_id', $userId)->where('year', $year->year)->first();
        if ($appData != null) {
            return $this->show($appData->id);
        } else {
            return $this->create();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dorms = Dormitory::all();
        $year = YearConfig::find(1);
        $prefixes = Prefix::all();
        $provinces = Province::all();
        $faculties = Faculty::all();
        $occs = Occupation::where('id', '<>', 1)->get();
        $edit = 1;
        $app = new Application();
        return view('application.create', compact('dorms', 'year', 'prefixes', 'provinces', 'faculties', 'edit', 'occs', 'app'));
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
        $rule = [
            'name' => 'required|string|max:255',
        ];
        $message = [
            'name.required' => 'กรุณาระบุชื่อ'
        ];

        $sp = $request->get('sp');

        if ($sp == 0) {
            $rule['name_sp'] = 'required';
            $rule['age_sp'] = 'required';
            $rule['occ_sp'] = 'required';
            $rule['relevance'] = 'required';
            $rule['monthly_income_sp'] = 'required';

            $message['name_sp.*'] = 'กรุณาระบุชื่อ';
            $message['age_sp.*'] = 'กรุณาระบุอายุ';
            $message['occ_sp.*'] = 'กรุณาเลือกอาชีพ';
            $message['relevance.*'] = 'กรุณาระบุความเกี่ยวข้อง';
            $message['monthly_income_sp.*'] = 'กรุณาระบุรายได้ต่อเดือน';
        }
        //$request->validate($rule, $message);

        $student_id = $request->input('student_id');
        $year = $request->input('year');

        $studentData = [
            'prefix_id' => $request->get('prefix'),
            'name' => $request->get('name'),
            'nickname' => $request->get('nickname'),
            'phone' => $request->get('phone'),
            'dob' => $request->get('dob'),
            'credit' => $request->get('credit'),
            'province_id' => $request->get('province'),
        ];

        DB::table('users')->where('id', $student_id)->update($studentData);

        $applicationData = [
            'student_id' => $student_id,
            'scholarship_name' => $request->get('scholarship_name'),
            'dorm_id' => $request->get('dorm_id'),
            'year' => $year,
            'monthly_expense' => $request->get('monthly_expense'),
            'underlying_disease' => $request->get('underlying_disease'),
            'relative_number' => $request->get('relative_number'),
            'being_number' => $request->get('being_number'),
            'graduated' => $request->get('graduated'),
            'in_progress' => $request->get('in_progress'),
            'name_fa' => $request->get('name_fa'),
            'age_fa' => $request->get('age_fa'),
            'occupation_fa' => $request->get('occ_fa'),
            'other_fa' => $request->get('other_fa'),
            'status_fa' => $request->get('status_fa'),
            'name_mo' => $request->get('name_mo'),
            'age_mo' => $request->get('age_mo'),
            'occupation_mo' => $request->get('occ_mo'),
            'other_mo' => $request->get('other_mo'),
            'status_mo' => $request->get('status_mo'),
            'family_monthly_income' => $request->get('fam_monthly_income'),
            'marital_status' => $request->get('marital_status'),
        ];

        if ($sp == 0) {
            $applicationData['name_sp'] = $request->get('name_sp');
            $applicationData['age_sp'] = $request->get('age_sp');
            $applicationData['occupation_sp'] = $request->get('occ_sp');
            $applicationData['other_sp'] = $request->get('other_sp');
            $applicationData['monthly_income_sp'] = $request->get('monthly_income_sp');
            $applicationData['relevance'] = $request->get('relevance');
        }

        $id = DB::table('applications')->insertGetId($applicationData);
        $app = Application::findOrFail($id);
        return redirect()->route('application.show', [$app]);
        //return view('application.show', compact('app'));
        // if($id != null){}
        // return $this->show($id);
        // return redirect()->action(
        //     [ApplicationController::class, 'show'],
        //     ['id' => $id]
        // );
        //return back()->with('status','บันทึกข้อมูลสำเร็จ');
    }

    public function showApp($id)
    {
        $app = Application::findOrFail($id);
        return view('interview.detail', compact('app'));
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
        try {
            $app = Application::findOrFail($id);
            return view('application.show', compact('app'));
        } catch (ModelNotFoundException $err) {
            return $this->create();
            //if id doesnt exist it will skip return view('profil..
            //and excute whatever in this section
        }
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
        $dorms = Dormitory::all();
        $year = YearConfig::find(1);
        $prefixes = Prefix::all();
        $provinces = Province::all();
        $faculties = Faculty::all();
        $occs = Occupation::where('id', '<>', 1)->get();
        $app = Application::findOrFail($id);
        $edit = 1;
        return view('application.edit', compact('app', 'year', 'occs', 'prefixes', 'provinces', 'dorms', 'edit'));
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
        $sp = $request->get('sp');
        $student_id = $request->input('student_id');
        $year = $request->input('year');

        $studentData = [
            'prefix_id' => $request->get('prefix'),
            'name' => $request->get('name'),
            'nickname' => $request->get('nickname'),
            'phone' => $request->get('phone'),
            'dob' => $request->get('dob'),
            'credit' => $request->get('credit'),
            'province_id' => $request->get('province'),
        ];

        DB::table('users')->where('id', $student_id)->update($studentData);

        $applicationData = [
            'student_id' => $student_id,
            'scholarship_name' => $request->get('scholarship_name'),
            'dorm_id' => $request->get('dorm_id'),
            'year' => $year,
            'monthly_expense' => $request->get('monthly_expense'),
            'underlying_disease' => $request->get('underlying_disease'),
            'relative_number' => $request->get('relative_number'),
            'being_number' => $request->get('being_number'),
            'graduated' => $request->get('graduated'),
            'in_progress' => $request->get('in_progress'),
            'name_fa' => $request->get('name_fa'),
            'age_fa' => $request->get('age_fa'),
            'occupation_fa' => $request->get('occ_fa'),
            'other_fa' => $request->get('other_fa'),
            'status_fa' => $request->get('status_fa'),
            'name_mo' => $request->get('name_mo'),
            'age_mo' => $request->get('age_mo'),
            'occupation_mo' => $request->get('occ_mo'),
            'other_mo' => $request->get('other_mo'),
            'status_mo' => $request->get('status_mo'),
            'family_monthly_income' => $request->get('fam_monthly_income'),
            'marital_status' => $request->get('marital_status'),
        ];

        if ($sp == 0) {
            $applicationData['name_sp'] = $request->get('name_sp');
            $applicationData['age_sp'] = $request->get('age_sp');
            $applicationData['occupation_sp'] = $request->get('occ_sp');
            $applicationData['other_sp'] = $request->get('other_sp');
            $applicationData['monthly_income_sp'] = $request->get('monthly_income_sp');
            $applicationData['relevance'] = $request->get('relevance');
        } else {
            $applicationData['name_sp'] = null;
            $applicationData['age_sp'] = null;
            $applicationData['occupation_sp'] = null;
            $applicationData['other_sp'] = null;
            $applicationData['monthly_income_sp'] = null;
            $applicationData['relevance'] = null;
        }

        DB::table('applications')->where('id', $id)->update($applicationData);
        $app = Application::findOrFail($id);
        return redirect()->route('application.show', [$app]);
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
        $app = Application::find($id);
        $interview  = Interview_score::where('application_id',$id)->delete();
        $result = Result::where('application_id',$id)->delete();
        $app->delete();
        return back()->with('status', 'ลบข้อมูลสำเร็จ');
    }
}
