<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kecukupan_gizi extends Model
{
		protected $table = 'Kecukupan_gizi';

		protected $primarykey = 'id_kecukupan_gizi';


		protected $filelable = ['id_kecukupan_gizi','kalori_minimum','protein_minimum','lemak_minimum','karbo_minimum','range_age','id_user','insert_at','updated_at'];
}
