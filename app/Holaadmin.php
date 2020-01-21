<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class Holaadmin extends Authenticatable
{
      use HasRoles;
    public function isRole(){
       //return $this->hasOne('App\Holaadminrole', 'id','hola_admin_roles');
          return $this->belongsTo('App\Holaadminrole','hola_admin_roles','id');
    }
    public function isAdmin(){
       if($this->isRole->hola_role =="administrator"){
       // return "admin";
      return true ;
        //  return true;
       }
       return false;
    }
}
