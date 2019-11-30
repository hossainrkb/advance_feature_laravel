<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all_user(){
        $userall = User::all();
        return view("all_user", compact("userall"));
    }
}
