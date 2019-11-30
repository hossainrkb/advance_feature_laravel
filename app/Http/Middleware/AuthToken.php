<?php

namespace App\Http\Middleware;

use Closure;

class AuthToken
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
       $token = $request->header("APP_KEY");
        if($token != "XYZ"){
            return response()->json(["message" =>'Unathorize mama'],401);
        }

      
            return $next($request);
        
       
    }
}
