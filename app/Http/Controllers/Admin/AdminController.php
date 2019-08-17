<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;
use App\Http\Models\Users;


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
									"header"  => view('part/header-menu-admin', $this->baseUrl()),
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
					"profile"  => Users::where('username', $sessi['username'])->get(),
					"part"     => array
									(
										"header"  => view('part/header-menu-admin', $this->baseUrl()),
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
										"header"  => view('part/header-menu-admin', $this->baseUrl()),
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
										"header"  => view('part/header-menu-admin', $this->baseUrl()),
										"menu"    => view('part/menu-admin', $this->baseUrl())
									)
				);
		return view('admin/users', $data);
	}


	public function info(Request $request)
	{
		$data = array
				(
					"title"    => "users web",
					"url"      => $this->url->to('/'),
					"part"     => array
									(
										"header"  => view('part/header-menu-admin', $this->baseUrl()),
										"menu"    => view('part/menu-admin', $this->baseUrl())
									)
				);
		return view('admin/info', $data);
	}







	private function baseUrl()
	{
		return array('url' => $this->url->to('/'));
	}
}