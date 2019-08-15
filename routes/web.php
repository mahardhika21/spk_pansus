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

Route::get('/', function () {
    return view('welcome');
});






Route::get('login', [
		"uses"  => "AuthController@view_login",
		"as"    => "web.login.view",
])->middleware('AuthLogin');


// login
Route::get('set_session', [
	"uses" => 'AuthController@set_manual_login',
	"as"   => 'web.auth.manual_session',
]);


// logouth
Route::get('logout', [
	"uses" => "AuthController@logout",
	"as"   => "web.auth.logouth"
]);


// route admin
Route::group(['middleware' => 'AuthPansus:admin'], function(){

	  Route::get('admin', function(){
	  		echo "admin";
	  });
});

  // route group panti 
Route::group(['middleware' => 'AuthPansus:panti'], function(){
	
	Route::get('panti', function(){
		echo "panti";
	});
});