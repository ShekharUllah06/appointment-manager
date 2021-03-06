<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Models\User;

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
     * Auth guard
     *
     * @var
     */
    protected $auth;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * LoginController constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $username   = $request->get('username');
        $password   = $request->get('password');
        $remember   = $request->get('remember');

        if ($this->auth->attempt([
            'username'  => $username,
            'password'  => $password,
            'activated' => 1,
        ], $remember == 1 ? true : false)) {
            
            //Code modified to allow redirection acording to user type -zaki
            if((User::where('username', $username)->first()->userType) == 1){
                return redirect()->route('doctor.dashboard');
            }elseif((User::where('username', $username)->first()->userType) == 2){
                return redirect()->route('patient.dashboard');
            }else{
                return redirect()->route('front.home');
            }

        }
        else {

            return redirect()->back()
                ->with('message','Incorrect username or password')
                ->with('status', 'danger')
                ->withInput();
        }

    }

}
