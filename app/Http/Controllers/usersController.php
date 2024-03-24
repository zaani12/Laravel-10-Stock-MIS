<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use App\Http\Models\User;

class usersController extends Controller
{
    public function loadView(){
        // return view("users",['name'=>'Mohammad Hussain']);
        // return view("users",['users'=>['ali','ahmad','karim']]);
        $data = ['ali','ahmad','karim'];
        // return view("users",['users'=>'karim']);
        return view("users",['users'=>$data]);
    }
    function getData(Request $req){
        // return " the form data would be asigned here"; 
     $req -> validate(['userName'=>'required | max: 20','password'=>'required | min:5']);
        return $req-> input();
    }
    // function index(){
    //     // echo"index function inside usesControllers";
    //     return DB::select('select * from usersInfo');
    // }
    
}
