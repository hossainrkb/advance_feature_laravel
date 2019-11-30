<?php
namespace App\Repro;

use App\Advancer;
use Carbon\Carbon;
class Advancers {
    CONST CACHE_KEY = "ADVANCER";
    public function all_data($name){
        $key = "all.{$name}";
        $cacheKey = $this->getCacheKey($key);
        return cache()->remember($cacheKey,Carbon::now()->addMinutes(5),function() use($name){
            return  Advancer::orderBy($name)->get();
        });
        
    }
    public function getCacheKey($key){
        $key = strtoupper($key);
        return self::CACHE_KEY.".$key";
    }
}

?>