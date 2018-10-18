<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
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

      public function index()
      {
        return Auth::user() -> id; //push out json
      }

      public function orders(Request $request){
        Auth::user()->id;
        if($request->user()->role_id == 2){
          return view('orders');
        }else if($request->user()->role_id == 3){
          return redirect('/employee');
        }else if($request->user()->role_id == 1){
          return redirect('/admin');
        }else{
          return redirect('/');
        }
      }

}
