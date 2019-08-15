<?php

namespace App\Http\Middleware;

use Closure;
class AuthPansus
{
	public function handle($request, Closure $next, $role)
	{
	 //  echo $role;

	   $sessi = $request->session()->get('roleAuth');
	   
	   if(empty($sessi))
	   {
	   	   return redirect('login');
	   }

	  

	   if($sessi['level'] != $role)
	   {
	   		return redirect($sessi['level']);
	   }

	   return $next($request);


	}
}