<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Extra;

class AdminBackendController extends Controller
{
		public function profile_crud(Request $request, $type)
		{
			$sessi = $request->session()->get('roleAuth');

			if($type == "update_profile")
			{

				$cek = User::where('email' $request->input('email'))->get();

				if(count($cek)>0)
				{
					$resp['status']  = 'false';
					$resp['code']    = 'success';
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
					$resp['code']    = 'danger';
					$resp['message'] = 'success update profile';

				}
				catch(\Illuminate\Database\QueryException $e)
				{
					$resp['status']  = 'false';
					$resp['code']    = 'danger';
					$resp['message'] = $e->getMessage();
				}
			}


			return redirect('admin/profile')->with(['msg'=> $resp]);
		}	  
}