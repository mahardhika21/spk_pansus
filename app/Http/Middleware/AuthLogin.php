<?php

namespace App\Http\Middleware;

use Closure;

class AuthLogin
{
	   function handle($request, Closure $next)
	   {
	   		$sessi = $request->session()->get('roleAuth');

	   		if(!empty($sessi))
	   		{
	   			return redirect($sessi['level']);
	   		}

	   		return $next($request);
	   }
}