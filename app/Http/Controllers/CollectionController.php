<?php
namespace App\Http\Controllers;

use Mail;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\collectMail;




class CollectionController extends Controller
{
    public function store(Request $request)
    {
      $objColl = new \stdClass();
      $objColl->collUser = $request->user;
      $objColl->collNum = $request->number;
      $objColl->collEmail = $request->email;
      Mail::to($request->email)->send(new collectMail($objColl));
      return  $request->email;
    }
}
