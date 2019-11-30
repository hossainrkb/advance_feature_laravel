<?php

namespace App;

use App\Advancer;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;


    public function advancer()
    {
        return  $this->hasMany(Advancer::class, 'dept');
    }
 
}
