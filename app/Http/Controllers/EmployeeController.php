<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Events\OrderEvent;
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

    public function employee(){
        return view('employee');
    }
   /*  public funtion send(request $request){
      $user = User::find(Auth::id());
      event(new ChatEvent($request -> $order, $user))
    } */
    public function send(){
      $order =["Order recieved"];
      $user = User::find(Auth::id());
      event(new OrderEvent($order, $user));
    }
}
