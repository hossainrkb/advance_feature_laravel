<?php 
namespace App\traits;

trait CollectionTrait {
    public static function check_collection (){
        $collection = collect(['a'=>2, 'b'=>3, 'c'=>4, 'd'=>5]);
        return self::take($collection,2);
    }

    public static function take($collection,$limit){
        foreach ($collection as $item){
            return $item;
        }
    }
}


?>