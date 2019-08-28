<?php 
namespace App\Model;

use Illuminate\Database\Elequent\Model;

class Pangan extends Model
{
		protected $table = 'pangan';

		protected $primarykey = 'id_pangan';

		protected $filelable = ['id_pangan','nama_pangan','type_pangan','kalori_pangan','protein_pangan','lemak_pangan','satuan_pangan','nominal_satuan','harga_pangan','insert_at','updated_at','id_user'];
}