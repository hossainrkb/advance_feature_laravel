<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
class reservationController extends Controller
{
    public function get_data(){
        $reservation= Reservation::all();
       // dd($reservation);
        return view("reservation" , ['reservation' => json_decode($reservation)]);
    }
}
