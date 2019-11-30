<?php

namespace App;

use App\Department;
use Illuminate\Database\Eloquent\Model;

class Advancer extends Model
{
     
    public $timestamps = false;
    protected $fillable = ["name", "phone","dept"];
    
    public function getDept (){
       // return $this->belongsTo('App\Department', 'd_id');
       // return Department::where("d_id",$this->dept)->first()->d_name;
        return $this->hasOne('App\Department', 'd_id','dept');
     // return  $this->hasOne(Department::class,'d_id');
    }
   
}
