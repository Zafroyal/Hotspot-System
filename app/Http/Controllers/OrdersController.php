<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Quotation;
use App\Orders;
use App\Product_Orders;

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


      public function oid()
      {
        $oid =  DB::select("SELECT AUTO_INCREMENT AS 'order_id' FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'orders'");
        return $oid; //push out json
      }


      public function store(Request $request)
      {

          Orders::create($request->all());



          //return (['message'] == 'Task was succesful');
      }


      public function update(Request $request)
      {

          DB::statement("UPDATE `orders` SET `ostatus` = $request->ostatus WHERE `orders`.`order_id` = $request->order_id;");



          //return (['message'] == 'Task was succesful');
      }

      public function storeorder_product(Request $request)
      {
          Product_Orders::create($request->all());
      }


      public function userOrder()
      {
          $userid =  Auth::user() -> id;

          $userorder = DB::select("SELECT  users.email, products.name, products.price, order_product.quantity, orders.order_id, orders.ostatus
            FROM users, orders, products, order_product WHERE users.id = orders.user_id AND products.id = order_product.p_id AND orders.order_id = order_product.o_id AND users.id = $userid;");
          return $userorder;//push out json
      }

      public function orderProducts(){
        $userid =  Auth::user() -> id;

        $userorder = DB::select("SELECT order_product.o_id, order_product.p_id, orders.user_id, products.name, products.price, order_product.quantity FROM order_product, products, orders
        WHERE order_product.p_id = products.id AND order_product.o_id = orders.order_id");
        return $userorder;//push out json
      }

      public function empOrders()
      {
          $userid =  Auth::user() -> id;

          $userorder = DB::select("SELECT orders.order_id,users.id, users.email, orders.ostatus
            FROM users, orders WHERE users.id = orders.user_id");
          return $userorder;//push out json
      }

      public function numOfCurrOrders(){
       return  DB::select("SELECT COUNT(*) FROM orders;");

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
