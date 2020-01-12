<?php

namespace App\Billings;

use Illuminate\Support\Str;

class PaymentGetway {

    private $courancy ; 
    private $discount;
    public function __construct($curn){
        $this->courancy = $curn;
        $this->discount = 0;
    }
    public function setDiscount($dis){
        $this->discount = $dis;
    }

    public function charge($amount){
        return [
            "amount" => $amount-$this->discount , 
            "confirmation_key" => Str::random(),
            "given_courancy" => $this->courancy,
            "discount" => $this->discount
        ];
    }


}