<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Dormitory;
use App\Models\DormitoryDetail;
use App\Models\Faculty;
use App\Models\Prefix;
use App\Models\Province;
use App\Models\Room;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'prefix' => ['required'],
            'nickname' => ['required'],
            'dob' => ['required'],
            'username' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'enroll' => ['required'],
            'province' => ['required'],
            'faculty' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $dormDetail = DB::table('dormitory_details')->where([
            ['dormitory_id', $data['dorm']],
            ['room_id', $data['room']]
        ])->first();
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'prefix_id' => $data['prefix'],
            'nickname' => $data['nickname'],
            'dob' => $data['dob'],
            'phone' => $data['phone'],
            'username' => $data['username'],
            'enrolled_year' => $data['enroll'],
            'dorm_detail_id' => $dormDetail->id,
            'province_id' => $data['province'],
            'faculty_id' => $data['faculty'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        $prefixes = Prefix::all();
        $provinces = Province::all();
        $faculties = Faculty::all();
        $dorms = Dormitory::all();
        $rooms = Room::all();
        $dorm_detail = DormitoryDetail::all();
        $app = new Application();
        return view('auth.register', [
            'title' => 'Register',
            'registerRoute' => 'register',
            'registerType' => '0',
            'prefixes' => $prefixes,
            'provinces' => $provinces,
            'faculties' => $faculties,
            'dorms' => $dorms,
            'edit' => 0,
            'app' => $app,
        ]);
    }
}
