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
  return view('landpage');
});


Route::get('/login', ['middleware' =>'guest', function(){
  return view('auth.login');
}]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->where('any','.*');

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/orders', function () {
    return view('orders');
});

Route::resource('/proapi', 'ProductController');

Route::resource('/cartapi', 'CartController');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
