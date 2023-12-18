<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Session;
class LockAccount
{
    
/**
     
* Handle an incoming request.
     
*
     
* @param  \Illuminate\Http\Request  $request
     
* @param  \Closure  $next
     
* @return mixed
     
*/
    
	public function handle($request, Closure $next, $guard = null)   
	{
	           
	    if ($request->session()->has('locked')) {

	    	return redirect('/lockscreen');	            
	    } 
	    
        return $next($request);
    
    }

}
