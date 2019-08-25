<?php
namespace App\Http\Models;

use Illuminate\Database\Elequent\Model;

class Users extends Model
{
	// table name
	protected $table = 'users';
    
    // primary key
    protected $primarykey ='id_user';
	
	// filed table
	protected $filelable = ['id_user', 'username', 'password', 'level','access','name','email','phone','insert_at','updated_at'];

}