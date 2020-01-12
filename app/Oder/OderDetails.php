<?php 

namespace App\Oder;

use App\Billings\PaymentGetway;

class OderDetails {
    private $payment;
    
    public function __construct(PaymentGetway $paymentgetway){
        $this->payment = $paymentgetway;
    }


    public function all(){
        $this->payment->setDiscount(50);
        return [
            "name"=> "rakib"
        ];
    }
}