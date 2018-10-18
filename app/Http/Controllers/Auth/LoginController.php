<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\User;

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
    protected function authenticated(Request $request, User $user){
      if($request->user()->role_id == 3){
        return redirect('/employee');
      }
      else if($request->user()->role_id == 2){
        return redirect('/home');
      }
      else if($request->user()->role_id == 1){
        return redirect('/admin');
      }
      else{
        return redirect('/');
      }



    }

    protected $redirectTo = '/home';

    //redirects after logout
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
