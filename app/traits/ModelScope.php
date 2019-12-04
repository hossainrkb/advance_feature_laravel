<?php 

namespace App\traits;

trait ModelScope
{
    public function scopeIsCSE($query)
    {
        return $query->where("dept", 1);
    }
}

?>