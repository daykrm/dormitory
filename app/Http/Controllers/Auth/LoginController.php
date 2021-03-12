<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Personel\HomeController as PersonelHomeController;
use App\Models\Dormitory;
use App\Models\Faculty;
use App\Models\Prefix;
use App\Models\Province;
use App\Models\Room;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->action([HomeController::class, 'index']);
        }

        if (Auth::guard('personel')->check()) {
            return redirect()->action([PersonelHomeController::class, 'index']);
        }

        return view('auth.login', [
            'title' => 'Login',
            'loginRoute' => 'login',
            'forgotPasswordRoute' => 'password.request',
        ]);
    }

    public function edit($id)
    {
        dd($id);
        $user = User::find($id);
        $prefixes = Prefix::all();
        $provinces = Province::all();
        $faculties = Faculty::all();
        $dorms = Dormitory::all();
        $rooms = Room::all();
        $dorm_detail = Dormitory::all();
        return view('auth.edit', compact('user', 'prefixes', 'provinces', 'faculties', 'dorms', 'rooms', 'dorm_detail'));
    }

    // public function authenticated()
    // {
    //     if (auth()->user()->hasRole('admin')) {
    //         return redirect('/admin/dashboard');
    //     }

    //     return redirect('/user/dashboard');
    // }
}
