<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;


class AuthController extends Controller
{
		private $url;

		function __construct(UrlGenerator $url)
		{
			$this->url = $url;
		}


		public function view_login(Request $request)
		{
			$data = array
						(
							"url" => $this->url->to('/'),
						);

			return view('login', $data);
		}

		public function set_manual_login(Request $request)
		{
			$data = array
		   			(
		   				"level"    => "admin",
		   				"access"   => "root",
		   				"username" => "admin",
		   				"email"    => "admin@gmail.com"
		   			);

   			$request->session()->put('roleAuth', $data);
   			echo "suskses";
		}


		public function logout(Request $request)
		{
			$request->session()->forget('roleAuth');
		    
		    $message = array
		    				(
		    					'status' => "success",
		    					'code'   => "success", 
		    					'message' => 'anda telah keluar dari sistem',
		    				);

		    return redirect('login')->with($message);
		}
}