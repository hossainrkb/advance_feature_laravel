<?php

namespace App\Http\Controllers;

use App\Holaadmin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;

class HolaadminController extends Controller
{
    public function index(){
      //  dump("hola bros");
       // Role::create(['guard_name' => 'admin','name' => 'something']);
       //Auth::guard("admin")->user()->assignRole("something");
       return json_decode(Auth::guard("admin")->user()->roles,true);
    }
    public function login_page(){
       if(Cache::has("holaadmin_credentials")){
       // dump("have");
       $cached = Cache::get("holaadmin_credentials");
       return redirect()->route("emni");
       }
       else{
            return view("hola_admin.login");
       }
    }
    public function regis_page(){
        return view("hola_admin.regis");
    }

    //login

    public function login (Request $re){
        //dd($re->email);
        if (Auth::guard('admin')->attempt(['hola_admin_email' => $re->email])) {
        return redirect()->route('hola_bros');
    //    dump([
    //        "message"=>"success",
    //        "data"=>json_decode(Auth::guard('admin')->user(),true),
    //        "role"=>json_decode(Auth :: guard ('admin')->user()->isRole,true),
    //        "AdminOrnot"=>Auth :: guard ('admin')->user()->isAdmin(),
    //    ]);
        
        } else {
            dump([
                "message"=>"failed"
            ]);
        }
    }
    public function regis (Request $re){
      //  dd($re->input());
        $holaadmin = new Holaadmin();
        $holaadmin->hola_admin_name = $re->name;
        $holaadmin->hola_admin_email = $re->email;
        $holaadmin->hola_admin_roles = 0;
        $holaadmin->save();
        Auth::guard('admin')->attempt(['hola_admin_email' => $re->email]);
        Cache::put('holaadmin_credentials', $re->input(), now()->addMinutes(10));
        return "cached and stored in database";
    }
}
