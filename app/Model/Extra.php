<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
		protected $table = 'extra';

		protected $primarykey = 'id_extra';

		protected $filelable = ['id_extra','nama','body','type','url','insert_at','update_at'];
}