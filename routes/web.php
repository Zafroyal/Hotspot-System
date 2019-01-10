<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
  return view('index');
});


Route::get('/login', ['middleware' =>'guest', function(){
  return view('auth.login');
}]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->where('any','.*')->middleware('auth');

Route::get('/cart', 'CartController@cart')->middleware('auth');

Route::get('/employee', 'EmployeeController@employee')->middleware('auth');

Route::get('orders','OrdersController@orders')->middleware('auth');

Route::get('/currentuserapi','OrdersController@index');

Route::get('/userorder','OrdersController@userOrder');

Route::get('/emporders','OrdersController@empOrders');

Route::get('/prodorders','OrdersController@orderProducts');

Route::get('/oid','OrdersController@oid');

Route::post('send','EmployeeController@send');

Route::post('reply','EmployeeController@reply');

Route::post('storeorder','OrdersController@store');

Route::post('storeorder_product','OrdersController@storeorder_product');



Route::resource('/proapi', 'ProductController');

Route::resource('/cartapi', 'CartController');

Route::resource('/collectapi', 'CollectionController');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
