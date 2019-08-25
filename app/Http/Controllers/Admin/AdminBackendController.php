<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Extra;
use App\Model\Users;
use DataTables;

class AdminBackendController extends Controller
{
		public function profile_crud(Request $request, $type)
		{
			$sessi = $request->session()->get('roleAuth');

			if($type == "update_profile")
			{

				$cek = User::where('email', $request->input('email'))->get();

				if(count($cek)>0 and $cek[0]['username'] != $sessi['username'])
				{
					$resp['status']  = 'false';
					$resp['code']    = 'danger';
					$resp['message'] = 'email input is alareday exits';

					return redirect('admin/profile')->with(['msg'=>$resp]);
				}

				DB::beginTransaction();

				try
				{
					$arr_data = array
								(
									"name"  => $request->input('name'),
									"phone" => $request->input('phone'),
									"email" => $request->input('email'),
								);
					User::where('username', $sessi['username'])->update($arr_data);

					DB::commit();

					$resp['status']  = 'true';
					$resp['code']    = 'success';
					$resp['message'] = 'success update profile';

				}
				catch(\Illuminate\Database\QueryException $e)
				{
					$resp['status']  = 'false';
					$resp['code']    = 'danger';
					$resp['message'] = $e->getMessage();
				}

				return redirect('admin/profile')->with(['msg'=> $resp]);
			}
			elseif($type == "reset_password")
			{
				$old_password   = $request->input('old_password');
				$new_passowrd   = $request->input('new_password');
				$renew_password = $request->input('renew_password');

				//echo $new_passowrd;
				//die();

				$cek = User::where('username', $sessi['username'])->where('password', md5($old_password))->get();
				if(count($cek) > 0)
				{
					if(strlen($new_passowrd) < 6)
					{
						$resp['status']  = 'false';
						$resp['code']    = 'danger';
						$resp['message'] = 'password minimun 6 karakter';

						return redirect('admin/reset_password')->with(['msg' => $resp]);
					}


					if($new_passowrd == $renew_password)
					{
						DB::beginTransaction();

						try
						{
							$arr_data = array("password" => md5($new_passowrd));
							User::where('username', $sessi['username'])->update($arr_data);

							$resp['status']  = 'true';
							$resp['code']    = 'success';
							$resp['message'] = 'success update password';

							DB::commit();
						}
						catch(\Illuminate\Database\QueryException $e)
						{
							$resp['status']  = 'false';
							$resp['code']    = 'danger';
							$resp['message'] = $e->message();
						}
					}
					else
					{
						$resp['status']  = 'fasle';
						$resp['code']    = 'danger';
						$resp['message'] = 'password baru tidak sama';
					}


				}
				else
				{
					$resp['status']  = 'false';
					$resp['code']    = 'code';
					$resp['message'] = 'update password galat, old password wrong';
 				}

 				return redirect('admin/reset_password')->with(['msg'=> $resp]);
			}


			
		}


		public function  info_crud(Request $request)
		{

			$id = $request->input('id_xtra');

			$cek = Extra::where('id_extra', $id)->where('type', 'info')->get();

			if(count($cek)>0)
			{
				DB::beginTransaction();

				try
				{
					$arr_data['body'] = $request->input('body');

					Extra::where('id_extra', $id)->update($arr_data);

					DB::commit();

					$resp['status']  = 'true';
					$resp['code']    = 'success';
					$resp['message'] = 'succces update info';

				}catch(\Illuminate\Database\QueryException $e)
				{
					$resp['status'] 	= 'false';
					$resp['code']   	= 'danger';
					$resp['message']	= $e->getMessage();
				}
			}
			else
			{
				DB::beginTransaction();

				try
				{
				   $arr_data = array
				   				(
				   					"nama" => "info",
				   					"type" => "info",
				   					"body" => $request->input('info'),
				   				);

				   	Extra::insert($arr_data);

				   	DB::commit();

				   	$resp['status']  = 'true';
				   	$resp['code']    = 'success';
				   	$resp['message'] = 'success insert data info';

				}catch(\Illuminate\Database\QueryException $e)
				{
					$resp['status'] 	= 'false';
					$resp['code']   	= 'danger';
					$resp['message']	= $e->getMessage();
				}
			}

			return redirect('admin/info')->with(['msg' => $resp]);
		}

	function list_users_json(Request $request)
	{
		$sessi = $request->session()->get('roleAuth');
		return DataTables::of(User::where('username','!=',$sessi['username'])->get())->make('true');
	}	  


	public function users_crud(Request $request, $type)
	{
		
		if($type == "insert_data")
		{

			$request->validate([
								   "username" => "required|min:6|max:15",
								   "level"    => "required",
								   "email"    => 'required|email'
							   ]);

			


			// if($request->input('level') != 'admin' or $request->input('level') != 'user')
			// {
			// 	$resp['status']  = 'false';
			// 	$resp['code']    = 'danger';
			// 	$resp['message'] = 'level cannot by null and must admin or user';

			// 	 return redirect('admin/users')->with(['msg'=> $resp]);

			// 	//return response()->json($resp, 200);
			// }

			DB::beginTransaction();

			try
			{
				$arr_data = array
							(
								"username"  => $request->input('username'),
								"level"     => $request->input('level'),
								"email"     => $request->input('email'),
								"password"  => md5($request->input('username')),
								"access"    => $request->input('level'),
							);

				User::insert($arr_data);

				DB::commit();

				$resp['status']   = 'true';
				$resp['code']    = 'success';
				$resp['message'] = 'success insert data user level '. $arr_data['level'];
			}
			catch(\Illuminate\Database\QueryException $e)
			{
				$resp['status']  = 'false';
				$resp['code']    = 'danger';
				$resp['message'] = $e->getMessage();
			}

			return redirect('admin/users')->with(['msg'=> $resp]);
			// return response()->json($resp, 200);

		}
		elseif($type == "delete_data")
		{
				$uname = $request->input('uname');

				if(empty($uname))
				{
					$resp['status']    = 'false';
					$resp['code']      = 'danger';
					$resp['message']   = 'username cannot by null';

					return response()->json($resp, 200);
				}

				DB::beginTransaction();

				try
				{
					User::where('username', $uname)->delete();

					DB::commit();

					$resp['status']  = 'true';
					$resp['code']    = 'success';
					$resp['message'] = 'success delete data';

				}
				catch(\Illuminate\Database\QueryException $e)
				{
					$resp['status']  = 'false';
					$resp['code']    = 'success';
					$resp['message'] = $e->getMessage();
				}

				return response()->json($resp , 200);
		}
		else
		{
			$resp['status']  = 'false';
			$resp['code']    = 'danger';
			$resp['message'] = 'type cannot by null or must insert data or delete data';

			return redirect('admin/user')->with(['msg'=> $resp]);
		}
	}
}