<?php 
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $tabel = 'menu';

	protected $primarykey = 'id_menu';

	protected $filelable  = ['id_menu','list_meu','tanggal_menu','hari_menu','status_menu','harga_menu','detail_harga_menu','insert_at','updated_at','id_user'];
}