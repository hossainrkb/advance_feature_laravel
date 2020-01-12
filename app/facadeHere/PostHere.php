<?php 

namespace App\facadeHere ;

class PostHere{
 //normal way
    // public static function any(){
    //     dump("inside");
    // }

    protected static function resolveFacade($name){
        return app()[$name];
    }
      public static function __callStatic($method, $arg){
     //  dd(app()['PostHere']->$method(...$arg));
       return (self::resolveFacade("PostHere"))->$method(...$arg);
        // dump($method);
       // dump($arg);
    }
}