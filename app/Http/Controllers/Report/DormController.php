<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Dormitory;
use App\Models\User;
use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DormController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($dormDetailId)
    {
        $year = YearConfig::find(1);
        $users = User::where('dd.dormitory_id', $dormDetailId)
        ->select('rooms.name as room','users.*')
        ->join('dormitory_details as dd','users.dorm_detail_id','=','dd.id')
        ->join('rooms','dd.room_id','=','rooms.id')
        ->where('users.type_id','<>','3')
        ->orderBy('rooms.name','ASC')
        ->get();
        return view('report.dorm.index', compact('year', 'users'));
    }
}
