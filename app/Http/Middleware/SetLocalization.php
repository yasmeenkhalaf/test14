<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class SetLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('locale')) 
        {
            app()->setLocale(Session::get('locale'));
        }
        return $next($request);
    }
    
}




