<?php

namespace App\Http\Controllers;

use App\Oder\OderDetails;
use Illuminate\Http\Request;
use App\facadeHere \PostHere;
use App\Billings\PaymentGetway;

class ServiceController extends Controller
{
    public function store(OderDetails $oderdetails, PaymentGetway $paymentgetway)
    { 
        //PaymentGetway $paymentgetway
        //normal way it is
       //  $paymentgetway = new PaymentGetway("BDT");
       $oderdetails->all();
        dd($paymentgetway->charge(500));
    }

    public function facade(){
       return PostHere::hello("hello from this side");
    }

  
}
