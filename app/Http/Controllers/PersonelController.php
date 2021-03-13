<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Personel\HomeController;
use App\Models\Dormitory;
use App\Models\Personel;
use App\Models\Prefix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonelController extends Controller
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
        $person = Personel::findOrFail($id);
        $prefixes = Prefix::all();
        $dorms = Dormitory::all();
        $edit = 1;
        return view('personel.edit', compact('id', 'person', 'prefixes', 'dorms', 'edit'));
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

        $person->name = $request->get('name');
        // $person->username = $request->get('username');
        $person->email = $request->get('email');
        $person->prefix_id = $request->get('prefix');

        if ($request->filled('password')) {
            $person->password = Hash::make($request->get('password'));
        }

        if ($person->save()) {
            $dorms = $request->get('dorm');

            DB::table('person_dorm_relas')->where('personel_id', $id)->whereNotIn('dorm_id', $dorms)->delete();

            foreach ($dorms as $item) {
                DB::table('person_dorm_relas')->upsert([
                    'personel_id' => $person->id,
                    'dorm_id' => $item,
                ], 'person_dorm_relas_personel_id_dorm_id_unique');
            }

            return redirect()->action([HomeController::class, 'index'])->with('status', 'อัพเดทข้อมูลสำเร็จ');
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
