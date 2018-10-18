<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request->user()->role_id == 2){
        return view('home');
      }else if($request->user()->role_id == 3){
        return redirect('/employee');
      }else if($request->user()->role_id == 1){
        return redirect('/admin');
      }else{
        return redirect('/');
      }

    }
}
