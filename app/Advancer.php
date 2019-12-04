<?php

namespace App;
use App\traits\ModelScope;
use App\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Advancer extends Model
{
     use ModelScope;
    public $timestamps = false;
    protected $fillable = ["name", "phone","dept"];
    
    public function getDept (){
       // return $this->belongsTo('App\Department', 'd_id');
       // return Department::where("d_id",$this->dept)->first()->d_name;
        return $this->hasOne('App\Department', 'd_id','dept');
     // return  $this->hasOne(Department::class,'d_id');
    }

    public function deptss($query){
        return $query->where("dept",1);
    }
//Global scope
  //  public static function boot(){
      //  parent::boot();
        //static::addGlobalScope("isCseDept", function(Builder $builder){
       //     $builder->where("dept",1);
      //  });
   //   static::addGlobalScope(new \App\Scopes\isCseDept);
  //  }

  //local scope 
 
   
}
