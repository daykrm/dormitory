<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dormitory;
use App\Models\DormitoryDetail;
use App\Models\Personel;
use App\Models\Prefix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonController extends Controller
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
        $persons = Personel::all();
        return view('admin.personel.index', compact('persons'));
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
        $prefixes = Prefix::all();
        return view('admin.personel.create', compact('prefixes', 'dorms'));
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
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:personels',
            'username' => 'required|string|unique:personels',
            'password' => 'required|string|min:6|confirmed'
        ];

        $request->validate($rules);

        $dorm = DB::table('dormitory_details')->where([
            ['dormitory_id', $request->get('dorm')],
            ['room_id', $request->get('room')]
        ])->first();

        $person = Personel::firstOrNew([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
            'email' => $request->get('email'),
            'prefix_id' => $request->get('prefix'),
            'dorm_detail_id' => $dorm->id,
        ]);

        $person->save();

        return redirect()->action([PersonController::class, 'index'])->with('status', 'เพิ่มข้อมูลสำเร็จ');
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
        $person = Personel::findOrFail($id);
        $prefixes = Prefix::all();
        $dorms = Dormitory::all();
        return view('admin.personel.edit', compact('id', 'person', 'prefixes', 'dorms'));
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
                'email' => 'required|email|unique:personels,email,' . $id,
                'password' => 'required|string|min:6|confirmed',
            ]);
        } else {
            $request->validate([
                'prefix' => 'required',
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:personels,email,' . $id,
            ]);
        }

        $person = Personel::find($id);

        $dorm = DB::table('dormitory_details')->where([
            ['dormitory_id', $request->get('dorm')],
            ['room_id', $request->get('room')]
        ])->first();

        $person->name = $request->get('name');
        $person->username = $request->get('username');
        $person->email = $request->get('email');
        $person->prefix_id = $request->get('prefix');
        $person->dorm_detail_id = $dorm->id;

        if($request->filled('password')){
            $person->password = Hash::make($request->get('password'));
        }

        $person->save();

        return redirect()->action([PersonController::class, 'index'])->with('status', 'อัพเดทข้อมูลสำเร็จ');
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
