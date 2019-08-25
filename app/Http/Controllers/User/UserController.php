<?php
namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;
use App\Model\Users;
use App\Model\Extra;


class UserController extends Controller
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
									"header"  => view('part/header-menu-panti', $this->baseUrl('dashboard')),
									"menu"    => view('part/menu-panti', $this->baseUrl())
								)
				);

		return view('users/dashboard', $data);
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
										"header"  => view('part/header-menu-panti', $this->baseUrl('profile')),
										"menu"    => view('part/menu-panti', $this->baseUrl())
									)
				);
		return view('users/profile', $data);
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
				
		return view('Users/reset_password', $data);
	}


	private function baseUrl($page='')
	{
		return array('url' => $this->url->to('/'),'page'=> "page");
	}
}