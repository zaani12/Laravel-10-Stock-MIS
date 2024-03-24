<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class addController extends Controller
{
    function addUser(Request $req){
       $data =  $req->input('userName');
        
       $req->session()->put('user',$data);
    //   return redirect('add');
    if($req->hasFile('file')){
        $newdata= $req->file('file')->store('images','public');
    
    }
    return true;
}
}