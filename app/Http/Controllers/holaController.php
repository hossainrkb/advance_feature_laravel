<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advancer;
use App\Events\vaiEvent;
use App\Events\NewHolahasRegisteredEvant;

class holaController extends Controller
{
    public function add_holas(Request $re){
        $ad = new Advancer();
        $ad->name = $re->hola;
        $ad->name = $re->hola;
        $ad->name = $re->hola;
        event(new vaiEvent($re->hola));
        $ad->save();
    }
}
