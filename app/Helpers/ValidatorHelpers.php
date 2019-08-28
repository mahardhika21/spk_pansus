<?php

namespace App\Helpers;

class ValidatorHelpers
{
	public function rulesValidator($type)
	{
		   if($type == "insert_data_pangan")
		   {
		   	   $rules = array
		   	   			(
		   	   				"nama_pangan"   	 => "required",
							"type_pangan"   	 => "required",
							"kalori_pangan" 	 => "required|numeric",
							"protein_pangan"     => "required|numeric",
							"lemak_pangan"       => "required|numeric",
							"satuan_pangan"      => "required",
							"nominal_satuan"     => "required|numeric",
							"harga_pangan"       => "required|numeric"
		   	   			);
		   }


		   return $rules;
	}


	public function messageValidator($type)
	{
		if($type === "insert_data_pangan")
		   {
		   	   $message = array
		   	   			(
		   	   				"nama_pangan.required"   	 => "nama pangan harus di isi",
							"type_pangan.required"   	 => "type pangan harus di isi",
							"kalori_pangan.required" 	 => "kalori pangan harus di isi",
							"kalori_pangan.numeric"      => "kalori pangan harus berupa angka atau numeric"
							"protein_pangan"     => "required|numeric",
							"lemak_pangan"       => "required|numeric",
							"satuan_pangan"      => "required",
							"nominal_satuan"     => "required|numeric",
							"harga_pangan"       => "required|numeric" 
		   	   			);
		   }

		 return $message;		
	}

	public function coba()
	{
		return "coba;";
	}
}