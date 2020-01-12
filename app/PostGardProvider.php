<?php 

namespace App;

class PostGardProvider {
    private $height ; 
    private $width ; 
    
    public function __construct($height,$width){
        $this->height = $height ; 
        $this->width = $width ; 
    }

    public function hello($message){
        return [
            "message" => $message
        ];
    }
}