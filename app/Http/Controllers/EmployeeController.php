<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Events\OrderEvent;
use App\Events\EmpEvent;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function employee(Request $request){
      if($request->user()->role_id == 2){
        return redirect('/home');
      }else if($request->user()->role_id == 3){
        return view('employee');
      }else if($request->user()->role_id == 1){
        return redirect('/admin');
      }else{
        return redirect('/');
      }


    }

   /* public function send(request $request){
      $user = User::find(Auth::id());
      event(new ChatEvent($request -> $order, $user))
    } */
    public function send(Request $request){
    //  Log::debug('Some message.');
      $complete = "Order complete come collect your order";
      $user = User::find(Auth::id());

      event(new OrderEvent($request -> orders, $user));
    }

    public function reply(Request $requests){
      event(new EmpEvent($requests -> usernames));
    }


}
