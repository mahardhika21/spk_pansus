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


	function dashboard(Request $request)
	{
		$data = array
				(
					"title"  => "dashboard",
					"url"    => $this->url->to('/'),
					"part"   => array
								(
									"header"  => "",
								)
				);

		return view('admin/dashboard', $data);
	}
}