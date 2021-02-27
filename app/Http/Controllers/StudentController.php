<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use App\Models\DormitoryDetail;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
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
        $dorm = Dormitory::all();
        return view('user.select', compact('dorm'));
    }

    public function getUserByDormId($dormId)
    {
        // $dorm = DormitoryDetail::where()->get();
        // $users = User::where([
        //     ''
        // ])->get();
        $dorms = Dormitory::all();
        $dorm = Dormitory::find($dormId);
        $users = $dorm->users()->where('type_id', '<>', 3)->simplePaginate(5);
        return view('user.index', compact('users', 'dormId', 'dorms', 'dorm'));
        //$users = User::where('username', 'testtest')->first();
        return back()->with('users', $users);
    }

    public function changeStatus($userId)
    {
        $user = User::find($userId);
        if ($user->type_id == 1) {
            $user->type_id = 2;
        } else {
            $user->type_id = 1;
        }
        if ($user->save()) {
            return back()->with('status', 'แก้ไขสถานะสำเร็จ');
        } else {
            return back()->with('error', 'แก้ไขสถานะล้มเหลว');
        }
    }

    public function findByUsername($username)
    {
        $user = User::where('username', $username)->first();
        if ($user != null) {
            return back()->with('user', $user);
        } else {
            return back()->with('error', 'ไม่พบนักศึกษารหัส ' . $username);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $user = User::find($id);
        return response()->json(['user' => $user]);
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
