<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
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
    //protected $redirectTo = RouteServiceProvider::HOME;

    //protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {

        $input = $request->all();
  
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        Session::forget('danger');
  
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if(auth()->attempt(array($fieldType => $input['login'], 'password' => $input['password'] , 'is_deleted'=>'0'))){
            $role = Auth::user()->role;
            if($role == 'admin') {
                return redirect('/admin/admin-dashboard');
            }
            else if($role == 'user') {
                return redirect('/dashboard');
            }
            else {
                return redirect('/');
            }
        }
        else {
            $request->session()->flash('danger', 'Invalid credentials or you are blocked.');
            return redirect('/');
        }
    }
}
