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

	  Route::get('admin/lauk', [
	  		"uses" => "Admin\AdminController@lauk_view",
	  		"as"   => "web.admin.lauk",
	  ]);

	  Route::get('admin/sayur', [
	  		"uses" => "Admin\AdminController@sayur_view", 
	  		"as"   => "web.admin.sayur",
	  ]);

	  Route::get('admin/mpokok', [
	  		"uses" => "Admin\AdminController@makanpokok_view",
	  		"as"   => "web.admin.makanpokok_view",
	  ]);

	  Route::get('admin/menu', [
	  		"uses" => "Admin\AdminController@menu_view",
	  		"as"   => "web.admin.menu",
	  ]);

	  Route::get('admin/gizi', [
	  		"uses" => "Admin\AdminController@gizi_view",
	  		"as"   => "web.admin.gizi",
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

	  Route::post('admin/backend/info_crud/', [
	  		"uses"	=> "Admin\AdminBackendController@info_crud",
	  		"as"    => "web.admin.info_crud",
	  ]);

	  Route::post('admin/backend/pangan_crud/{type}', [
	  		"uses" 	=> "Admin\AdminBackendController@pangan_crud",
	  		"as"	=> "web.admin.pangan_crud"
	  ]);

	  Route::post('admin/backend/kecukupan_gizi_crud/{type}', [
	  		"uses"  => "Admin\AdminBackendController@kecukupan_gizi_crud",
	  		"as"    => "web.kecukupan_gizi.crud",
	  ]);

	  Route::get('admin/backend/generate_menu', [
	  		"uses"   => 'Admin\AdminBackendController@generate_menu',
	  		"as"     => 'web.admin.generate_menu'
	  ]);

	  Route::post('admin/backend/save_menu',[
	  		"uses"   => 'Admin\AdminBackendController@save_menu',
	  		"as"     => 'web.admin.generate_menu'
	  ]);

	  Route::post('admin/backend/delete_menu', [
	  		"uses"  => 'Admin\AdminBackendController@delete_menu',
	  		"as"    => "web.admin.delete_menu",
	  ]);

	  Route::get('admin/backend/get_menu_detail/{id}', [
	  		"uses"  => 'Admin\AdminBackendController@get_menu_detail',
	  		"as"    => "web.admin.delete_menu",
	  ]);

	   

	  // dattable

	  Route::get('admin/data/list_users_json', [
	  		"uses"  => "Admin\AdminBackendController@list_users_json",
	  		"as" 	=> "web.admin.list_users_json",
	  ]);

	  Route::get('admin/data/list_pangan_json/{type}', [
	  		"uses"  => "Admin\AdminBackendController@list_pangan_json",
	  		"as"    => "web.admin.list_pangan_json",
	  ]);


	  Route::get('admin/data/list_gizi_json/', [
	  		"uses"  => "Admin\AdminBackendController@list_gizi_json",
	  		"as"    => "web.admin.list_pangan_json",
	  ]);

	  Route::get('admin/data/list_menu_json', [
	  		"uses"  => "Admin\AdminBackendController@list_menu_json",
	  		"as"	=> "web.admin.list_menu_json",
	  ]);

	
});

  // route group panti 
Route::group(['middleware' => 'AuthPansus:user'], function(){
	
	// view user

	  Route::get('user', [
	  		"uses"  => "User\UserController@dashboard",
	  		"as"    => "web.user.dashboard",
	  ]);

	  Route::get('user/profile', [
	  		"uses"  => "User\UserController@profile",
	  		"as"	=> "web.user.profile",
	  ]);

	  Route::get('user/reset_password', [
	  		"uses"	=> "User\UserController@reset_password",
	  		"as"    => "web.user.profile",
	  ]);



	  //post data

	   Route::post('user/backend/reset_password', [
	  		"uses" => "User\UserBackendController@reset_password",
	  		"as"   => "web.admin.backend_resert_password",
	  ]);

	  Route::post('user/backend/profile_crud/{type}', [
	  		"uses"  => "User\UserBackendController@profile_crud",
	  		"as"    => "web.admin.profile_crud",
	  ]);


	  // list datatables

	  Route::get('user/data/list_menu_json', [
	  		"uses"  => "User\UserBackendController@list_menu_json",
	  		"as"	=> "web.admin.list_menu_json",
	  ]);

	  Route::get('user/backend/get_menu_detail/{id}', [
	  		"uses"  => 'Admin\AdminBackendController@get_menu_detail',
	  		"as"    => "web.admin.delete_menu",
	  ]);


});