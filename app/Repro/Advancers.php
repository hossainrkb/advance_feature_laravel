<?php
namespace App\Repro;

use App\Advancer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

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

    public function fetchAll()
    {
        $result = Cache::remember('blog_posts_cache', 5000, function () {
            Redis::connection();
            return  Advancer::all();
        });

        return $result;
    }

}

?>