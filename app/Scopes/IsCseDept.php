<?php

namespace App\Scopes;

use App\Advancer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class isCseDept implements Scope
{

   

    public function apply(Builder $builder , Model $model)
    {
         $builder->where("dept", true);
    }
}
