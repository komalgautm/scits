<?php

namespace App\Http\Middleware;
use Closure;
use Session;

class CheckAdminAuth
{
	public function handle($request, Closure $next)
    {
	    if(!Session::has('scitsAdminSession'))
	    {  
            return redirect('admin/login');
        } 
        
        return $next($request);
    }
	
}