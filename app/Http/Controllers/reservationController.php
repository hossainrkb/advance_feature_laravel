<?php

namespace App\Http\Controllers;

use App\traits\ReservationTrait;
use Illuminate\Http\Request;
use App\Reservation;
use App\Json;
class reservationController extends Controller
{
    public function get_data(){
        $reservation= Reservation::all();
       // dd($reservation);
        return view("reservation" , ['reservation' => json_decode($reservation)]);
    }
    use ReservationTrait;

    public function show_create(){
        return view("json_take");

    }
    public function json_store(Request $re){
        $json = new Json();
       $code = '{
    "mm":"'.$re->name.'",
    "Coords": [{
        "precision":"40",
        "Accuracy": "30",
        "Latitude": "53.2778273",
        "Longitude": "-9.0121648",
        "Timestamp": "Fri Jun 28 2013 11:43:57 GMT+0100 (IST)"
    }]
}';



$json5 = json_decode($code, true);


        $data = $re->only('name', 'phone', 'email','r1','r2');
       // dd(gettype(json_encode($data)));
        $json->data = json_encode($json5);
        dd(gettype(json_encode($json5)));

        $json->save();
        session()->flash('success', "data added");
        return json_encode($json5);



    }
}
