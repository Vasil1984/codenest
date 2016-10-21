<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthUser
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
    
        if(Auth::user()->role == 0){
            return redirect()->to('/home');
        }
        return $next($request);
    }
}
