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
							"kalori_pangan.numeric"      => "kalori pangan harus berupa angka atau numeric",
							"protein_pangan.required"    => "protein pangan harus di isi",
							"protein_pangan.numeric"	 => "protein pangan harus berupa angka atau numeric", 
							"lemak_pangan.required"      => "lemak pangan harus di isi",
							"lemak_pangan.numeric"       => "lemak pangan harus berupa angka atau numeric",
							"satuan_pangan.required"     => "satuan pangan harus di isi",
							"satuan_pangan.numeric"      => "satuan pangan harus berupa angka atau numeric",
							"nominal_satuan.required"    => "nominal satuan pangan  harus di isi",
							"nominal_satuan.numeric"     => "nominal satuan pangan harus berupa angka atau numeric",
							"harga_pangan.required"      => "nominal satuan pangan  harus di isi",
							"harga_pangan.numeric"       => "harga pangan satuan pangan harus berupa angka atau numeric",
		   	   			);
		   }

		 return $message;		
	}

	public function coba()
	{
		return "coba;";
	}
}