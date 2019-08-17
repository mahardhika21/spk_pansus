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
    return redirect('login');
});






Route::get('login', [
		"uses"  => "AuthController@view_login",
		"as"    => "web.login.view",
])->middleware('AuthLogin');

Route::post('set_login', [
	   "uses" => "AuthController@set_login",
	   "as"   => "web.set_login",

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
      
      // view admin
	  Route::get('admin', [
	  		"uses" => "Admin\AdminController@dashboard",
	  		"as"   => "web.admin.dashboard",
	  ]);	

	  Route::get('admin/profile',[
	  		"uses" => "Admin\AdminController@profile",
	  		"as"   => "web.admin.profile",
	  ]);

	  Route::get('admin/reset_password', [
		  	"uses" => "Admin\AdminController@reset_password",
		  	"as"   => "web.admin.reset_password"
	  ]);

	  Route::get('admin/users', [
	  		"uses" => "Admin\AdminController@users",
	  		"as"   => "web.admin.users",
	  ]);

	  Route::get('admin/info', [
	  		"uses" => "Admin\AdminController@info",
	  		"as"   => "web.admin.info",
	  ]);


	  // operation post

	  Route::post('admin/backend/reset_password', [
	  		"uses" => "Admin\AdminBackendController@reset_password",
	  		"as"   => "web.admin.backend_resert_password",
	  ]);

	  Route::post('admin/backend/profile_crud/{type}', [
	  		"uses"  => "Admin\AdminBackendController@profile_crud",
	  		"as"    => "web.admin.profile_crud",
	  ]);

	  Route::post('admin/backend/users_crud/{info}', [
	  		"uses"  => "Admin\AdminBackendController@users_crud",
	  		"as"    => "web.admin.users_crud",
	  ]);

	  Route::post('admin/backend/info_crud/{info}', [
	  		"users"	=> "Admin\AdminBackendController@info_crud",
	  		"as"    => "web.admin.info_crud",
	  ]);


	  // dattable

	  Route::get('admin/data/list_users_json', [
	  		"uses"  => "Admin\AdminBackendController@list_users_json",
	  		"as" 	=> "web.admin.list_users_json",
	  ]);

	
});

  // route group panti 
Route::group(['middleware' => 'AuthPansus:user'], function(){
	
	Route::get('panti', function(){
		echo "panti";
	});
});