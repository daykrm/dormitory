<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use App\Models\Faculty;
use App\Models\Prefix;
use App\Models\Province;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = User::find($id);
        $prefixes = Prefix::all();
        $provinces = Province::all();
        $faculties = Faculty::all();
        $dorms = Dormitory::all();
        $rooms = Room::all();
        $dorm_detail = Dormitory::all();
        $route = 'student.update';
        return view('auth.edit', compact('user', 'prefixes', 'provinces', 'faculties', 'dorms', 'rooms', 'dorm_detail', 'route'));
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
        if ($request->filled('password')) {
            $request->validate([
                'prefix' => 'required',
                'name' => 'required|string|max:100',
                'nickname' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required|string|min:6|confirmed',
            ]);
        } else {
            $request->validate([
                'prefix' => 'required',
                'name' => 'required|string|max:100',
                'nickname' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);
        }

        $dormDetail = DB::table('dormitory_details')->where([
            ['dormitory_id', $request->get('dorm')],
            ['room_id', $request->get('room')]
        ])->first();

        $user = User::find($id);

        $user->prefix_id = $request->get('prefix');
        $user->name = $request->get('name');
        $user->nickname = $request->get('nickname');
        $user->phone = $request->get('phone');
        $user->dob = $request->get('dob');
        $user->province_id = $request->get('province');
        $user->email = $request->get('email');
        $user->faculty_id = $request->get('faculty');
        $user->enrolled_year = $request->get('enroll');
        $user->dorm_detail_id = $dormDetail->id;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->get('password'));
        }

        if ($user->save()) {
            return redirect()->action([HomeController::class, 'index'])->with('status', 'แก้ไขข้อมูลสำเร็จ');
        } else {
            return redirect()->action([HomeController::class, 'index'])->with('error', 'แก้ไขข้อมูลล้มเหลว');
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

    public function showPDPA($id)
    {
        $previousRoute = route('home');
        if ($id == 1) {
            $nextRoute = route('register');
        } else {
            $nextRoute = route('checkApp', Auth::user()->id);
        }

        return view('pdpa', compact('nextRoute', 'previousRoute'));
    }
}
