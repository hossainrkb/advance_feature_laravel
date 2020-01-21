<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class TestMiddleware
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
       // dd("fff");
      //  dd(Auth::guard ('admin')->user()->isAdmin("administrator"));
       // dd($request->user("admin"));
       // dd();
       if(Auth :: guard ('admin')->check()){
          // dd(Auth::guard("admin")->user()->isAdmin());
          return $next($request);
       }
       else{
           dd("false badda");
       }
    //  dd($request->Auth::guard('admin')->check());
       // $admin = Auth::guard("admin")->user();
       // dd($admin);
     //   dd($request->user()->isAdmin("hola") );
       // dump(Auth :: guard ('admin')->user()->isAdmin());
        // if(Auth :: guard ('admin')->user()->isAdmin()){
        //     dump("get in");
        // }
        // else{
        //     dump("get out");
        // }
        //return $next($request);
    }
}
