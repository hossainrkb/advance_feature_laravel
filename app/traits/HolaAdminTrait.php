<?php 

namespace App\traits;
use App\Holaadmin;
use Illuminate\Support\Arr;

class HolaAdminTrait{
    public static function admins(){
        $all = Holaadmin::all();
        $empty_arr = [];
        foreach($all as $value){
            $data = [
                "name"=> $value->hola_admin_name,
                "email"=> $value->hola_admin_email,
                "role"=> $value->isRole->hola_role,
            ];
            $empty_arr = Arr::prepend($empty_arr,$data);
           // $empty_arr.push($data);
        }
        return $empty_arr;
    }
}