<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserControllers extends Controller
{
    function fetchUserData (){
        return User::all();
    }
}
