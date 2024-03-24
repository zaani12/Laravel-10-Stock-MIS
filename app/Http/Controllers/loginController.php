<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    function userLogin (Request $request){
        $request -> validate(['userName'=>'required | max: 20','password'=>'required | min:5']);
        $data= $request->input();
        $request->session()->put('user',$data['userName']);
        // echo session('user');

        return redirect('fetchEmployees');
    }
}
