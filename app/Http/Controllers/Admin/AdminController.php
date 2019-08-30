<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;
use App\Model\Users;
use App\Model\Extra;


class AdminController extends Controller
{
	private $url;

	function __construct(UrlGenerator $url)
	{
		$this->url = $url;
	}


	public function dashboard(Request $request)
	{
		$data = array
				(
					"title"  => "dashboard",
					"url"    => $this->url->to('/'),
					"part"   => array
								(
									"header"  => view('part/header-menu-admin', $this->baseUrl('dashboard')),
									"menu"    => view('part/menu-admin', $this->baseUrl())
								)
				);

		return view('admin/dashboard', $data);
	}


	public function profile(Request $request)
	{
		$sessi = $request->session()->get('roleAuth');
		$data = array
				(
					"title"    => "profile admin",
					"url"      => $this->url->to('/'),
					"profile"  => User::where('username', $sessi['username'])->get(),
					"part"     => array
									(
										"header"  => view('part/header-menu-admin', $this->baseUrl('profile')),
										"menu"    => view('part/menu-admin', $this->baseUrl())
									)
				);
		return view('admin/profile', $data);
	}


	public function reset_password(Request $request)
	{
		$data = array
				(
					"title"    => "reset password admin",
					"url"      => $this->url->to('/'),
					"part"     => array
									(
										"header"  => view('part/header-menu-admin', $this->baseUrl('reset_password')),
										"menu"    => view('part/menu-admin', $this->baseUrl())
									)
				);
				
		return view('admin/reset_password', $data);
	}


	public function users(Request $request)
	{
		$data = array
				(
					"title"    => "users web",
					"url"      => $this->url->to('/'),
					"part"     => array
									(
										"header"  => view('part/header-menu-admin', $this->baseUrl('users')),
										"menu"    => view('part/menu-admin', $this->baseUrl())
									)
				);
		return view('admin/users', $data);
	}


	public function info(Request $request)
	{
		$data = array
				(
					"title"    => "Info web",
					"url"      => $this->url->to('/'),
					"info"     => Extra::where('type','info')->get(),
					"part"     => array
									(
										"header"  => view('part/header-menu-admin', $this->baseUrl('about')),
										"menu"    => view('part/menu-admin', $this->baseUrl())
									)
				);

		return view('admin/info', $data);
	}


	public function lauk_view(Request $request)
	{
		$data = array 
				(
					"title"    => "lauk",
					"url"      => $this->url->to('/'),
					"part"     => array
								(
									"header"   => view('part/header-menu-admin', $this->baseUrl()),
									"menu" 	   => view('part/menu-admin', $this->baseUrl())
								)
				);

		return view('admin/lauk', $data);
	}


	public function sayur_view(Request $request)
	{
		$data = array
				(
					"title"    => "sayur",
					"url"      => $this->url->to('/'),
					"part"     => array
								(
									"header"  => view('part/header-menu-admin', $this->baseUrl()),
									"menu"    => view('part/menu-admin', $this->baseUrl())
								)
				);

		return view('admin/sayur', $data);
	}


	public function makanpokok_view(Request $request)
	{
		$data = array
				(
					"title"    => "makanan pokok",
					"url"      => $this->url->to('/'),
					"part"     => array
								(
									"header"  => view('part/header-menu-admin', $this->baseUrl()),
									"menu"    => view('part/menu-admin', $this->baseUrl())
								)
				);

		return view('admin/makanan_pokok', $data);
	}

	public function menu_view(Request $request)
	{
		$data = array
				(
					"title"    => "menu",
					"url"      => $this->url->to('/'),
					"part"     => array
								(
									"header"  => view('part/header-menu-admin', $this->baseUrl()),
									"menu"    => view('part/menu-admin', $this->baseUrl())
								)
				);

		return view('admin/menu', $data);
	}







	private function baseUrl($page='')
	{
		return array('url' => $this->url->to('/'),'page' => $page);
	}
}