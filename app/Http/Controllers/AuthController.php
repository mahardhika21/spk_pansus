<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;
use App\Http\Models\Users;

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
							"title" => "Login | SPK",
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

		    return redirect('login')->with('msg',$message);
		}



		public function set_login(Request $request)
		{
			$data = $request->input('login');


			if(!empty($data['username']) and !empty($data['password']))
			{
					$log = User::where('username', $data['username'])
								->where('password', md5($data['password']))
								->get();

					if(count($log)>0)
					{
							$data_log = array
										(				
							   				"level"    => $log[0]->level,
							   				"access"   => $log[0]->access,
							   				"username" => $log[0]->username,
							   				"id"       => $log[0]->id_user,
										);
							$request->session()->put('roleAuth', $data_log);

							return redirect($log[0]->level); 
					}
					else
					{
						$resp = array('status' => "error", 'code' =>'danger', 'message' => 'password/username yang anda masukkan salah');

						return redirect('login')->with(['msg' => $resp]);
					}
			}
			else
			{
				 $resp = array('status' => 'error', 'code' => 'danger', 'message' => 'username/password tidak boleh dikosongkan');


				return redirect('login')->with(['msg' => $resp]);
			}

		}


		public function update_password(Request $request)
		{
			$data = $request->input('password');
			$sessi = $request->session()->get('roleAuth');

			if($data['new_password'] != $data['renew_password'])
			{
				$resp = array
							(
								"status"  => "error",
								"code"    => "danger",
								"message" => "password baru yang di masukkan tidak sama",
							);
			}
			else
			{
					 $reset = User::where('username', $sessi['username'])
					 			->where('password', md5($data['old_password']))
					 			->get();

					 if(count($reset)>0)
					 {
					 		DB::beginTransaction();

					 		try
					 		{
					 			$arr_data['password'] = md5($data['new_password']);
					 			User::where('username'. $sessi['username'])->update($arr_data);

					 			DB::commit();

					 			$resp = array
					 						(
					 							"status"   => "success",
					 							"code"     => "success",
					 							"message"  => "password success update",
					 						);

					 		}
					 		catch(\Illuminate\Database\QueryException $e)
					 		{
					 				$resp = array
					 							(
					 								"status"  => "error",
					 								"code"    => "danger",
					 								"message" => $e->getMessage(),
					 							);

					 		}
					   }
					   else
				 {
				 		$resp = array
				 					(
				 						"status"  => "error",
				 						"code"    => "daner",
				 						"message" => "password Lama yang anda masukkan salah",
				 					);
				 }
			     }
				 

				 return redirect($sessi['level'].'/reset_password')->with(['msg' => $resp]);


			}

		}
