<?php
namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Extra;
use App\Model\Users;
use DataTables;

class UserBackendController extends Controller
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


		
}