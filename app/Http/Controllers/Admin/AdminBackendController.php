<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Extra;
use App\Model\Users;
use App\Model\Pangan;
use App\Model\Menu;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ValidatorHelpers;
use App\Model\Kecukupan_gizi;

class AdminBackendController extends Controller
{
		private $rule;

		function __construct()
		{
				$this->rule = new ValidatorHelpers();
		}
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
    
    function list_pangan_json(Request $request, $type)
    {
    	return DataTables::of(Pangan::where('type_pangan', $type)->get())->make('true');	
    }


    function list_gizi_json(Request $request)
    {
    	return DataTables::of(Kecukupan_gizi::all())->make('true');
    }


    function list_menu_json(Request $request)
    {
    	return DataTables::of(Menu::orderBy('id_menu','desc')->get())->make('true');
    }


	public function users_crud(Request $request, $type)
	{
		
		if($type == "insert_data")
		{


			// start validate 
			$rules = array(
							"username" => "required|min:6|max:15",
							"level"    => "required",
							"email"    => 'required|email'
						   );

			$message = array(
								"username.required" => "username cannot by null",
								"username.min"      => "username minimal 6 caracter",
								"username.max"      => "username maximal 15 caracter",
								"level.required"    => "level cannot by null",
								"email.required"	=> "email cannot by null",
								"email.email"       => "format email wrong",
							);

			$validator = validator::make($request->all(), $rules, $message);

			if ($validator->fails())
			{
				$errors = $validator->messages()->first();
			  

			    $resp['status']  = 'false';
				$resp['code']    = 'danger';
				$resp['message'] =  $errors;

				return redirect('admin/users')->with(['msg'=> $resp]);
			}

			// end validate

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


	public function pangan_crud(Request $request, $type)
	{
		$sessi = $request->session()->get('roleAuth');
		if($type == "insert_data_pangan")
		{

			// $validator = Validator::make($request->all(), $this->rule->rulesValidator($type), $this->rule->messageValidator($type));

			// if($validator->fails())
			// {
			// 	$resp['status'] = 'true';
			// 	$resp['code']   = 'danger';
			// 	$resp['message'] = $validator->messages()->first();

			// 	return redirect('admin/'. $request->input('type_pangan'))->with(['msg' => $resp]);
			// }

			DB::beginTransaction();

			try
			{
				$arr_data = array
							(
								"nama_pangan"   	 => $request->input('nama_pangan'),
								"type_pangan"   	 => $request->input('type_pangan'),
								"kalori_pangan" 	 => $request->input('kalori_pangan'),
								"protein_pangan"     => $request->input('protein_pangan'),
								"lemak_pangan"       => $request->input('lemak_pangan'),
								"karbo_pangan"      => $request->input('karbo_pangan'),
								"harga_pangan"       => $request->input('harga_pangan'),
								'id_user'            => $sessi['id'],
							);

				Pangan::insert($arr_data);

				DB::commit();

				$resp['status'] = 'true';
				$resp['code']   = 'success';
				$resp['message'] = "succes insert data ". $request->input('type_pangan') ;


			}catch(\Illuminate\Database\QueryException $e)
			{ 
				$resp['status'] = 'true';
				$resp['code']   = 'danger';
				$resp['message'] = $e->getMessage();	
			}

			return redirect('admin/'. $request->input('type_pangan'))->with(['msg' => $resp]);

		}
		elseif($type == "update_data_pangan")
		{
			$typeValidator = "insert_data_pangan";

			//$validator = Validator::make($request->all(), $this->rule->rulesValidator($typeValidator));

			// if($validator->fails())
			// {
			// 	$resp['status']  = 'false';
			// 	$resp['code']    = 'danger';
			// 	$reps['message'] = $validator->message()->first();

			// 	return redirect('admin/' . $request->input('type_pangan'))->with(['msg' => $resp]);
			// }

			  DB::beginTransaction();

			try
			{
				$arr_data = array
							(
								"nama_pangan"   	 => $request->input('nama_pangan'),
								"type_pangan"   	 => $request->input('type_pangan'),
								"kalori_pangan" 	 => $request->input('kalori_pangan'),
								"protein_pangan"     => $request->input('protein_pangan'),
								"lemak_pangan"       => $request->input('lemak_pangan'),
								"karbo_pangan"      => $request->input('karbo_pangan'),
								"harga_pangan"       => $request->input('harga_pangan')
							);

			    Pangan::where('id_pangan', $request->input('id_pangan'))->update($arr_data);

			    DB::commit();

			    $resp['status'] = 'true';
				$resp['code']   = 'success';
				$resp['message'] = "succes update data ". $request->input('type_pangan') ;


			}catch(\Illuminate\Database\QueryException $e)
			{
				$resp['status']  = 'false';
				$resp['code']    = 'danger';
				$resp['message'] = $e->getMessage();
			}

			return redirect('admin/'. $request->input('type_pangan'))->with(['msg' => $resp]);
		}
		elseif($type === "delete_data_pangan")
		{
			if(count(Pangan::where('id_pangan', $request->input('id_pangan'))->get())> 0)
			{
				DB::beginTransaction();

				try
				{
					Pangan::where('id_pangan', $request->input('id_pangan'))->delete();

					DB::commit();

				    $resp['status'] = 'true';
					$resp['code']   = 'success';
					$resp['message'] = "succes delete  data ". $request->input('type_pangan');


				}catch(\Illuminate\Database\QueryException $e)
				{
					$resp['status']  = 'false';
					$resp['code']    = 'danger';
					$resp['message'] = $e->getMessage();
				}
			}
			else
			{
				$resp['status']  = 'false';
				$resp['code']    = 'danger';
				$resp['message'] = 'delete data' .$request->input('type_pangan').' gagal, data tidak dtemukan';
			}

			return response()->json($resp, 200);

		}


	}


 public function kecukupan_gizi_crud(Request $request, $type)
		{

			// die();
			$sessi = $request->session()->get('roleAuth');
			if($type == "insert_data")
			{
				DB::beginTransaction();

				try
				{
						$arr_data = array
							(
								"kalori_minimum"   	 => $request->input('kalori_minimum'),
								"protein_minimum"   	 => $request->input('protein_minimum'),
								"lemak_minimum" 	 => $request->input('lemak_minimum'),
								"karbo_minimum"      => $request->input('karbo_minimum'),
								"range_age"          => $request->input('range_age'),
								"id_user"            => $sessi['id'],
							);

							// echo "sds";
							// die();

			    Kecukupan_gizi::insert($arr_data);

			    DB::commit();

			    $resp['status'] = 'true';
				$resp['code']   = 'success';
				$resp['message'] = "succes insert data kecukupan gizi" ;

			
				}catch(\Illuminate\Database\QueryException $e)
				{
					$resp['status']  = 'false';
					$resp['code']    = 'danger';
					$resp['message'] = $e->getMessage();
				}
			}elseif($type == "update_data")
			{
				$id = $request->input('id_kecukupan_gizi');

				if(empty($id))
				{
					$resp['status']  = 'false';
					$resp['code']    = 'danger';
					$resp['message'] = 'data id tidak boleh kosong';

					return redirect('admin/gizi')->with(['msg' => $resp]);	
				}
				DB::beginTransaction();

				try
				{
						$arr_data = array
							(
								"kalori_minimum"   	 => $request->input('kalori_minimum'),
								"protein_minimum"   	 => $request->input('protein_minimum'),
								"lemak_minimum" 	 => $request->input('lemak_minimum'),
								"karbo_minimum"      => $request->input('karbo_minimum'),
								"range_age"          => $request->input('range_age'),
							);

				// echo '<pre>'.print_r($arr_data, true) .'</pre>';
				// die();
			    Kecukupan_gizi::where('id_kecukupan_gizi', $id)->update($arr_data);

			    DB::commit();

			    $resp['status'] = 'true';
				$resp['code']   = 'success';
				$resp['message'] = "succes insert data kecukupan gizi" ;

			
				}catch(\Illuminate\Database\QueryException $e)
				{
					$resp['status']  = 'false';
					$resp['code']    = 'danger';
					$resp['message'] = $e->getMessage();
				}

			}elseif($type == "delete_data")
			{
				$id = $request->input('id');

				if(empty($id))
				{
					$resp['status']  = 'false';
					$resp['code']    = 'danger';
					$resp['message'] = 'data id tidak boleh kosong';	
				}
				else
				{
					DB::beginTransaction();
					try
					{
						Kecukupan_gizi::where('id_kecukupan_gizi', $id)->delete();

						DB::commit();

						$resp['status']  = 'true';
						$resp['code']    = 'success';
						$resp['message'] = 'success delete data';

					}catch(\Illuminate\Database\QueryException $e)
					{
						$resp['status']  = 'false';
					    $resp['code']    = 'danger';
					    $resp['message'] = 'data id tidak boleh kosong';
					}
				}

				return response()->json($resp, 200);
			}

			return redirect('admin/gizi')->with(['msg' => $resp]);
		}

public function hari($tanggal)
	{
		  $day  = date('D', strtotime($tanggal));

		  $hari = array
           			(
           				"Sun" => "Minggu",
           				"Mon" => "Senin",
           				"Tue" => "Selasa",
           				"Wed" => "Rabu",
           				"Thu" => "Kamis",
           				"Fri" => "Jumat",
           				"Sat" => "Sabtu"
           			);

		  if(array_key_exists($day, $hari))
		  {
		  	  return $hari[$day];
		  }
		  else
		  {
		  	  return $day;
		  }

           
	}
public function generate_menu(Request $request)
{
	 $id_gizi = $request->input('id');
	// $makan     = $request->input('makan');
	 $tgl   = $request->input('tgl');

	 // $tgl    = str_replace("/", "-", $tgl);
	 // $tgl    = date('Y-m-d', strtotime($tgl));

	 if(strtotime(date('Y-m-d'))>strtotime(date($tgl)))
	 {
	 	$resp['status']  = 'false' . $tgl;
	 	$resp['code']    = 'danger';
	 	$resp['message'] = 'tanggal sudah lewat';

	 	return response()->json($resp, 200);
	 }


	//$id_gizi   = 3;
	$makan     = 3;
	//$tgl       = '2019-09-19';
	$cek       = Menu::where('tanggal_menu', $tgl)->get();
	$hari      = $this->hari($tgl);

	//echo $hari;

	if(count($cek)>0)
	{
		$resp['status']  = 'false';
		$resp['code']    = 'danger';
		$resp['message'] = 'tanggal alareday exist';

		return response()->json($resp, 200);
	}

    // get info kecukupan gizi
	$data  = Kecukupan_gizi::where('id_kecukupan_gizi', $id_gizi)->first();


	//echo '<pre>'.print_r($data, true) .'</pre>';

	//echo $data['id_kecukupan_gizi'];
    // generate gizi info
	$gizi = array( 'per_kalori' => round($data['kalori_minimum'] / $makan, 2),'per_protein' => round($data['protein_minimum'] / $makan, 2),'per_lemak' => round($data['lemak_minimum'] / $makan, 2),'per_karbo' => round($data['karbo_minimum'] / $makan, 2),'total_makan' => $makan);
	//echo '<pre>'.print_r($gizi, true) .'</pre>';

	// generate menu

	$menu_combine = array("pangan" => array
											(
												"sayur"  => array
															    (
																	"name"     => array(),
																	"id"       => array(),
																	"harga_kg" => array(), 
																	"harga_gr" => array(),
																	"kalori"   => array(),
																	"protein"  => array(),
																	"lemak"    => array(),
																	"karbo"    => array(),
																	"index_of" => array(),
																),
												"lauk"   => array
																(
																 "name"     => array(),
																 "id"       => array(),
																 "harga_kg" => array(),
																 "harga_gr" => array(),
																 "kalori"   => array(),
																 "protein"  => array(),
																 "lemak"    => array(),
																 "karbo"    => array(),
																 "index_of" => array(),
																),
												"mpokok" => array
																(	
																	"name"     => array(),
																	"id"       => array(),
																	"harga_kg" => array(), 
																	"harga_gr" => array(),
																	"kalori"   => array(),
																	"protein"  => array(),
																	"lemak"    => array(),
																	"karbo"    => array(),
																	"index_of" => array(),
															     ),
											),
						  "menu"   => array
						  				(
						  					"pagi"   => array
						  								(
						  									"k1" => array
						  												(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  												),
						  									"k2" => array
						  												(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  												),
						  									"k3" => array(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  													),
						  									
						  								),
						  					"siang"  => array
						  									(
							  									"k1" => array
						  												(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  												),
						  									   "k2" => array
						  												(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  												),
						  									   "k3" => array(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  													),
						  									),
						  					"malam"  => array
						  									(
						  								       "k1" => array
						  												(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  												),
						  									   "k2" => array
						  												(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  												),
						  									    "k3" => array(
						  													"kalori"  => array(),
						  													"protein" => array(),
						  													"lemak"   => array(),
						  													"karbo"   => array(),
						  													"id_pangan" => array
								  												(
								  													'x1' => array(),
								  													"x2" => array(),
								  													"x3" => array(),
								  												),
						  													)
						  									),
						  		),
						  	"gizi"     => $gizi,
						  	"id_gizi"  => $id_gizi,
						  	"tgl"      => $tgl,
						  	"hari"     => $hari
						);

	$pangan = Pangan::get();
     
     $index_of_sayur = 0;
     $index_of_lauk  = 0;
     $index_of_mpokok = 0;
	foreach ($pangan as $dt) 
	{
		if($dt['type_pangan'] == 'sayur')
		{

			 array_push($menu_combine['pangan']['sayur']['name'], $dt['nama_pangan']);
			 array_push($menu_combine['pangan']['sayur']['id'], $dt['id_pangan']);
			 array_push($menu_combine['pangan']['sayur']['harga_kg'], $dt['harga_pangan']);
			 array_push($menu_combine['pangan']['sayur']['kalori'], $dt['kalori_pangan']);
			 array_push($menu_combine['pangan']['sayur']['protein'], $dt['protein_pangan']);
			 array_push($menu_combine['pangan']['sayur']['lemak'], $dt['lemak_pangan']);
			 array_push($menu_combine['pangan']['sayur']['karbo'], $dt['karbo_pangan']);
			 array_push($menu_combine['pangan']['sayur']['harga_gr'], ceil($dt['harga_pangan']/1000));
			// array_push($menu_combine['pangan']['sayur']['index_of'],$index_of_sayur);

			 $index_of_sayur = $index_of_sayur + 1;

				
		}
		elseif($dt['type_pangan'] == 'lauk')
		{

			 array_push($menu_combine['pangan']['lauk']['name'], $dt['nama_pangan']);
			 array_push($menu_combine['pangan']['lauk']['id'], $dt['id_pangan']);
			 array_push($menu_combine['pangan']['lauk']['harga_kg'], $dt['harga_pangan']);
			 array_push($menu_combine['pangan']['lauk']['kalori'], $dt['kalori_pangan']);
			 array_push($menu_combine['pangan']['lauk']['protein'], $dt['protein_pangan']);
			 array_push($menu_combine['pangan']['lauk']['lemak'], $dt['lemak_pangan']);
			 array_push($menu_combine['pangan']['lauk']['karbo'], $dt['karbo_pangan']);
			 array_push($menu_combine['pangan']['lauk']['harga_gr'], ceil($dt['harga_pangan']/1000));

			// array_push($menu_combine['pangan']['sayur']['index_of'],$index_of_lauk);

			 $index_of_lauk = $index_of_lauk + 1;
		}
		elseif($dt['type_pangan'] == 'mpokok')
		{

			 array_push($menu_combine['pangan']['mpokok']['name'], $dt['nama_pangan']);
			 array_push($menu_combine['pangan']['mpokok']['id'], $dt['id_pangan']);
			 array_push($menu_combine['pangan']['mpokok']['harga_kg'], $dt['harga_pangan']);
			 array_push($menu_combine['pangan']['mpokok']['kalori'], $dt['kalori_pangan']);
			 array_push($menu_combine['pangan']['mpokok']['protein'], $dt['protein_pangan']);
			 array_push($menu_combine['pangan']['mpokok']['lemak'], $dt['lemak_pangan']);
			 array_push($menu_combine['pangan']['mpokok']['karbo'], $dt['karbo_pangan']);
			 array_push($menu_combine['pangan']['mpokok']['harga_gr'], ceil($dt['harga_pangan']/1000));

			 //array_push($menu_combine['pangan']['mpokok']['index_of'],$index_of_mpokok);

			 $index_of_mpokok = $index_of_mpokok + 1;	   
		}

	}

	$menu_combine2 = $menu_combine;



	// array_push($menu_combine['pangan']['sayur']['index_of'],$index_of_sayur);
	// array_push($menu_combine['pangan']['lauk']['index_of'],$index_of_lauk);
	// array_push($menu_combine['pangan']['mpokok']['index_of'],$index_of_mpokok);

  // proses generate menu 
	for($i=0; $i<$makan; $i++) // for waktu makan // pagi siang sore
	{
		for($j=0; $j<$makan; $j++) // kombine k1,k2,3
		{
		   $gizi_pokok = 4;
           for($k=0; $k<$gizi_pokok; $k++) // gizi kalori,lemak,pro,karbo
           {
           	  $x1 = rand(0, count($menu_combine2['pangan']['mpokok']['name']) - 1 );
           	  $x2 = rand(0, count($menu_combine2['pangan']['sayur']['name']) - 1);
           	  $x3 = rand(0, count($menu_combine2['pangan']['lauk']['name']) - 1);
           	  //echo $menu_combine2['pangan']['mpokok']['index_of'] .'<br>';
           	  //echo '<pre>'.print_r($menu_combine2, true) .'</pre>';
           	//  echo $x1 .' '. $x2 .' '. $x3;
           	 // die();

           	  if($k === 0)
           	  {
           	  	  $cx = $menu_combine['pangan']['mpokok']['kalori'][$x1].'x1 + '.$menu_combine['pangan']['sayur']['kalori'][$x2].'x2 + '.$menu_combine['pangan']['lauk']['kalori'][$x3] .'x3 <= '. $menu_combine['gizi']['per_kalori'];
           	  }
           	  elseif($k == 1)
           	  {
           	  		$cx = $menu_combine['pangan']['mpokok']['protein'][$x1].'x1 + '.$menu_combine['pangan']['sayur']['protein'][$x2].'x2 + '.$menu_combine['pangan']['lauk']['protein'][$x3] .'x3 <= '. $menu_combine['gizi']['per_protein'];
           	  }elseif($k == 2)
           	  {
           	  		$cx = $menu_combine['pangan']['mpokok']['lemak'][$x1].'x1 + '.$menu_combine['pangan']['sayur']['lemak'][$x2].'x2 + '.$menu_combine['pangan']['lauk']['lemak'][$x3] .'x3 <= '. $menu_combine['gizi']['per_lemak'];
           	  }
           	  elseif($k == 3)
           	  {
           	  	$cx = $menu_combine['pangan']['mpokok']['karbo'][$x1].'x1 + '.$menu_combine['pangan']['sayur']['karbo'][$x2].'x2 + '.$menu_combine['pangan']['lauk']['karbo'][$x3] .'x3 <= '. $menu_combine['gizi']['per_karbo'];
           	  }

           	  if($i == 0)
           	  {
	           	  	  if($j == 0)
	           	  	  {
	           	  	  	 if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k1']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k1']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k1']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k1']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k1']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k1']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k1']['karbo'], $cx);
	           	  	  	 }
	           	  	  }
	           	  	  elseif($j == 1)
	           	  	  {
	           	  	  	  if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k2']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k2']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k2']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k2']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k2']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k2']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k2']['karbo'], $cx);
	           	  	  	 }
	           	  	  }
	           	  	  elseif($j == 2)
	           	  	  {
	           	  	  	 if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k3']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k3']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k3']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k3']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k3']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k3']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['pagi']['k3']['karbo'], $cx);
	           	  	  	 }
	           	  	  }

           	  }
           	  elseif($i == 1)
           	  {
           	  	 	if($j == 0)
	           	  	  {
	           	  	  	 if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k1']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k1']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k1']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k1']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k1']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k1']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k1']['karbo'], $cx);
	           	  	  	 }
	           	  	  }
	           	  	  elseif($j == 1)
	           	  	  {
	           	  	  	  if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k2']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k2']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k2']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k2']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k2']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k2']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k2']['karbo'], $cx);
	           	  	  	 }
	           	  	  }
	           	  	  elseif($j == 2)
	           	  	  {
	           	  	  	 if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k3']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k3']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k3']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['siang']['k3']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k3']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k3']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['siang']['k3']['karbo'], $cx);
	           	  	  	 }
	           	  	  }
           	  }
           	  elseif($i == 2)
           	  {
           	      if($j == 0)
	           	  	  {
	           	  	  	 if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k1']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k1']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k1']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k1']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k1']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k1']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k1']['karbo'], $cx);
	           	  	  	 }
	           	  	  }
	           	  	  elseif($j == 1)
	           	  	  {
	           	  	  	  if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k2']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k2']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k2']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k2']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k2']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k2']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k2']['karbo'], $cx);
	           	  	  	 }
	           	  	  }
	           	  	  elseif($j == 2)
	           	  	  {
	           	  	  	 if($k == 0)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k3']['kalori'], $cx);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k3']['id_pangan']['x1'], $menu_combine['pangan']['mpokok']['id'][$x1]);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k3']['id_pangan']['x2'], $menu_combine['pangan']['sayur']['id'][$x2]);
	           	  	  	 	array_push($menu_combine['menu']['malam']['k3']['id_pangan']['x3'], $menu_combine['pangan']['lauk']['id'][$x3]);
	           	  	  	 }
	           	  	  	 elseif($k == 1)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k3']['protein'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 2)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k3']['lemak'], $cx);
	           	  	  	 }
	           	  	  	 elseif($k == 3)
	           	  	  	 {
	           	  	  	 	array_push($menu_combine['menu']['malam']['k3']['karbo'], $cx);
	           	  	  	 }
	           	  	  }	
           	  }

           }
		}
	}

	//echo '<pre>'.print_r($pangan, true) .'</pre>';

	//echo '<pre>'.print_r($menu_combine, true) .'</pre>';

	// echo '<pre>'.print_r($du, true) .'</pre>';


	return response()->json($menu_combine, 200);


}


public function save_menu(Request $request)
{
     $simpleks = json_decode($request->input('simpleks'), true);
     $req      = json_decode($request->input('resp'), true);

     // echo '---------------------- simpleks-----------------';
      //echo '<pre>'.print_r($simpleks, true) .'</pe>';


    //  echo '---------------------- resp-----------------';
     // echo '<pre>'.print_r($req, true) .'</pe>';

      // for ($i=1; $i < 4; $i++) { 
      // 	   for ($j=1; $j<4; $j++) 
      // 	   { 
      	   	        
      // 	   }
      // }


      // $index_pg = rand(1,3);
      // $index_sg = rand(1,3);
      // $index_ml = rand(1,3);
     
      // $menu     =  array
      // 					(
      // 						"pagi" => array
      // 								(
      // 									"sayur"  => array
      // 													(
      // 														"name"   => $req['pangan']['sayur']['name'][(int)array_search($simpleks['pagi']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$index_pg]['result']['x2'], 2)),
      // 														"harga"  => $req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_pg]['result']['x2'], 2)),
      // 													),
      // 								    "lauk"  => array
      // 													(
      // 														"name"   => $req['pangan']['lauk']['name'][(int)array_search($simpleks['pagi']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$index_pg]['result']['x3'], 2)),
      // 														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_pg]['result']['x3'], 2)),
      // 													),
      // 									"mpokok"  => array
      // 													(
      // 														"name"   => $req['pangan']['mpokok']['name'][(int)array_search($simpleks['pagi']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$index_pg]['result']['x1'], 2)),
      // 														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_pg]['result']['x1'], 2)),
      // 													)
      // 								),
      // 						"siang" => array
      // 								(
      // 									"sayur"  => array
      // 													(
      // 														"name"   => $req['pangan']['sayur']['name'][(int)array_search($simpleks['pagi']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['siang']['k'.$index_sg]['result']['x2'], 2)),
      // 														"harga"  => $req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_sg]['result']['x2'], 2)),
      // 													),
      // 								    "lauk"  => array
      // 													(
      // 														"name"   => $req['pangan']['lauk']['name'][(int)array_search($simpleks['pagi']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$index_sg]['result']['x3'], 2)),
      // 														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_sg]['result']['x3'], 2)),
      // 													),
      // 									"mpokok"  => array
      // 													(
      // 														"name"   => $req['pangan']['mpokok']['name'][(int)array_search($simpleks['siang']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$index_sg]['result']['x1'], 2)),
      // 														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_sg]['result']['x1'], 2)),
      // 													)
      // 								),
      // 						"malam" => array
      // 								(
      // 									"sayur"  => array
      // 													(
      // 														"name"   => $req['pangan']['sayur']['name'][(int)array_search($simpleks['malam']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['siang']['k'.$index_ml]['result']['x2'], 2)),
      // 														"harga"  => $req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_ml]['result']['x2'], 2)),
      // 													),
      // 								    "lauk"  => array
      // 													(
      // 														"name"   => $req['pangan']['lauk']['name'][(int)array_search($simpleks['malam']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$index_ml]['result']['x3'], 2)),
      // 														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_ml]['result']['x3'], 2)),
      // 													),
      // 									"mpokok"  => array
      // 													(
      // 														"name"   => $req['pangan']['mpokok']['name'][(int)array_search($simpleks['malam']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])],
      // 														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$index_ml]['result']['x1'], 2)),
      // 														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$index_ml]['result']['x1'], 2)),
      // 													)
      // 								),

      // 					);

      //  $menu['total_harga'] = (int)$menu['pagi']['sayur']['harga']+(int)$menu['pagi']['lauk']['harga'] +(int)$menu['pagi']['mpokok']['harga']+(int)$menu['siang']['sayur']['harga']+(int)$menu['siang']['lauk']['harga'] +(int)$menu['siang']['mpokok']['harga']+(int)$menu['malam']['sayur']['harga']+(int)$menu['malam']['lauk']['harga'] +(int)$menu['malam']['mpokok']['harga'];

      // echo '--------------- menu ----------';
      // echo '<pre>'.print_r($menu, true).'</pre>';

       $index_pg = rand(1,3);
      $index_sg = rand(1,3);
      $index_ml = rand(1,3);
     $detail_menu = array();
     for($i=1; $i<4; $i++)
     {
     	$total_harga_pagi = ($req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x2'], 2)))+($req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x3'], 2)))+($req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x1'], 2)));
     	$total_harga_siang = ($req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x2'], 2)))+($req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x3'], 2)))+($req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x1'], 2)));
     	$total_harga_malam = ($req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['malam']['k'.$i]['result']['x2'], 2)))+($req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['malam']['k'.$i]['result']['x3'], 2)))+($req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['malam']['k'.$i]['result']['x1'], 2)));

    
      $menu     =  array
      					(
      						"pagi" => array
      								(
      									"sayur"  => array
      													(
      														"name"   => $req['pangan']['sayur']['name'][(int)array_search($simpleks['pagi']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x2'], 2)),
      														"harga"  => $req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x2'], 2)),
      													),
      								    "lauk"  => array
      													(
      														"name"   => $req['pangan']['lauk']['name'][(int)array_search($simpleks['pagi']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x3'], 2)),
      														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x3'], 2)),
      													),
      									"mpokok"  => array
      													(
      														"name"   => $req['pangan']['mpokok']['name'][(int)array_search($simpleks['pagi']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x1'], 2)),
      														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['pagi']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['pagi']['k'.$i]['result']['x1'], 2)),
      													),
      									'total_harga' => $total_harga_pagi,
      								),
      						"siang" => array
      								(
      									"sayur"  => array
      													(
      														"name"   => $req['pangan']['sayur']['name'][(int)array_search($simpleks['siang']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x2'], 2)),
      														"harga"  => $req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x2'], 2)),
      													),
      								    "lauk"  => array
      													(
      														"name"   => $req['pangan']['lauk']['name'][(int)array_search($simpleks['siang']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x3'], 2)),
      														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x3'], 2)),
      													),
      									"mpokok"  => array
      													(
      														"name"   => $req['pangan']['mpokok']['name'][(int)array_search($simpleks['siang']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x1'], 2)),
      														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['siang']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x1'], 2)),
      													),
      									'total_harga' => $total_harga_siang,
      								),
      						"malam" => array
      								(
      									"sayur"  => array
      													(
      														"name"   => $req['pangan']['sayur']['name'][(int)array_search($simpleks['malam']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x2'], 2)),
      														"harga"  => $req['pangan']['sayur']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x2'][0],$req['pangan']['sayur']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x2'], 2)),
      													),
      								    "lauk"  => array
      													(
      														"name"   => $req['pangan']['lauk']['name'][(int)array_search($simpleks['malam']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x3'], 2)),
      														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x3'][0],$req['pangan']['lauk']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x3'], 2)),
      													),
      									"mpokok"  => array
      													(
      														"name"   => $req['pangan']['mpokok']['name'][(int)array_search($simpleks['malam']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])],
      														"jumlah" => $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x1'], 2)),
      														"harga"  => $req['pangan']['lauk']['harga_gr'][(int)array_search($simpleks['malam']['id_pangan']['x1'][0],$req['pangan']['mpokok']['id'])] * $this->takaran_gnr(round($simpleks['siang']['k'.$i]['result']['x1'], 2)),
      													),
      									'total_harga' => $total_harga_malam,
      								),

      					);

 		$menu['pagi']['total_harga'] = (int)$menu['pagi']['sayur']['harga']+(int)$menu['pagi']['lauk']['harga']+(int)$menu['pagi']['mpokok']['harga'];
 		$menu['siang']['total_harga'] = (int)$menu['siang']['sayur']['harga']+(int)$menu['siang']['lauk']['harga']+(int)$menu['siang']['mpokok']['harga'];
 		$menu['malam']['total_harga'] = (int)$menu['malam']['sayur']['harga']+(int)$menu['malam']['lauk']['harga']+(int)$menu['malam']['mpokok']['harga'];

       // $menu['total_harga'] = (int)$menu['pagi']['sayur']['harga']+(int)$menu['pagi']['lauk']['harga'] +(int)$menu['pagi']['mpokok']['harga']+(int)$menu['siang']['sayur']['harga']+(int)$menu['siang']['lauk']['harga'] +(int)$menu['siang']['mpokok']['harga']+(int)$menu['malam']['sayur']['harga']+(int)$menu['malam']['lauk']['harga'] +(int)$menu['malam']['mpokok']['harga'];

		array_push($detail_menu, $menu);

      }
      // echo '--------------- menu ----------';
      // echo '<pre>'.print_r($detail_menu, true).'</pre>';
      $n = 0;
      foreach($detail_menu as $detail)
      {
      	  if($n == 0)
      	  {
      	  		$result['pagi']  = $detail['pagi'];
      	  		$tt_pagi         = $detail['pagi']['total_harga'];
      	  		$result['siang'] = $detail['siang'];
      	  		$tt_siang         = $detail['siang']['total_harga'];
      	  		$result['malam'] = $detail['malam'];
      	  		$tt_malam         = $detail['malam']['total_harga'];
      	  		
      	  }
      	  else
      	  {
      	  	  if($tt_pagi > $detail['pagi']['total_harga'])
      	  	  {
      	  	  	$result['pagi']  = $detail['pagi'];
      	  		$tt_pagi         = $detail['pagi']['total_harga'];
      	  	  }
      	  	  if($tt_siang > $detail['siang']['total_harga'])
      	  	  {
      	  	  	$result['siang'] = $detail['siang'];
      	  		$tt_siang         = $detail['siang']['total_harga'];
      	  	  }
      	  	  if($tt_malam > $detail['malam']['total_harga'])
      	  	  {
      	  	  	$result['malam']  = $detail['malam'];
      	  		$tt_siang         = $detail['malam']['total_harga'];
      	  	  }
      	  }
      }

      $result['total_all'] = (int)$result['pagi']['total_harga']+(int)$result['siang']['total_harga']+(int)$result['malam']['total_harga'];

      //echo '----------- result -------------';
      //echo '<pre>'.print_r($result, true).'</pre>';

      $sessi = $request->session()->get('roleAuth');

      $arr_data = array
      				(
      					"list_menu"    => serialize($result),
      					"tanggal_menu" 			=> $req['tgl'],
      					"hari_menu"	   			=> $req['hari'],
      					"status_menu"  			=> "true",
      					"id_user" 				=> $sessi['id'],
      					"harga_menu"			=> $result['total_all'],
      					"id_kecukupan_gizi"		=> $req['id_gizi']
      				);

      DB::beginTransaction();

      try
      {
      		Menu::insert($arr_data);

      		$resp['status']  = 'true';
      		$resp['code']    = 'success';
      		$resp['message'] = 'success generate data menu';

      		DB::commit();

      }
      catch(\Illuminate\Database\QueryException $e)
      {
      		$resp['status']  = 'false';
      		$resp['code']    = 'danger';
      		$resp['message'] = $e->getMessage();
      }


      return response()->json($resp, 200);
}


function takaran_gnr($num)
{
	 if($num == 0 or $num < 0)
	 {
	 	return 35;
	 }
	 else
	 {
	 	 return $num;
	 }
}
	

public function delete_menu(Request $request)
{
	$id = $request->input('id');

	DB::beginTransaction();

	try
	{
		Menu::where('id_menu', $id)->delete();

		DB::commit();

		    $resp['status']  = 'true';
      		$resp['code']    = 'danger';
      		$resp['message'] = 'success delete data';

	}catch(\Illuminate\Database\QueryException $e)
	{
		    $resp['status']  = 'false';
      		$resp['code']    = 'danger';
      		$resp['message'] = $e->getMessage();
	}

	return response()->json($resp, 200);
}


public function get_menu_detail(Request $request, $id)
{

		//$data = Menu::where('id_menu', $id)->get();
        $data = DB::table('menu')->select('menu.*', 'kecukupan_gizi.range_age')
        		->join('kecukupan_gizi','menu.id_kecukupan_gizi','=','kecukupan_gizi.id_kecukupan_gizi')
        		->where('menu.id_menu',$id)
        		->get();
		//echo '<pre>'.print_r($data, true).'</pre>';
		//die();
		//echo $data[0]['hari_menu'];
		if(count($data)>0)
		{

		    $resp['status']  = 'true';
      		$resp['code']    = 'danger';
      		$resp['message'] = 'success get data';
      		$resp['data']    = $data;
      		$resp['list_menu'] = unserialize($data[0]->list_menu);
		}
		else
		{
			$resp['status']  = 'false';
      		$resp['code']    = 'danger';
      		$resp['message'] = 'data not fount';
		}


		return response()->json($resp, 200);
}

}