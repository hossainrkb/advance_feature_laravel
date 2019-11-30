<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public function getuser(){
        return $this->belongsTo(User::class, "the_user","id");
    }
}
