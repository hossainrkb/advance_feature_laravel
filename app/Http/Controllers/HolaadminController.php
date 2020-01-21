<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
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
        return view("hola_admin.login");
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
}
