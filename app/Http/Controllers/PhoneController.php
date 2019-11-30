<?php

namespace App\Http\Controllers;

use App\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function all_phone()
    {
        $phoneall = Phone::all();
        return view("all_phone", compact("phoneall"));
    }
}
