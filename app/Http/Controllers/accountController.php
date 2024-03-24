<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class accountController extends Controller
{
    function display(){
        // $accounts= AccountModel::all();
        $accounts= AccountModel::paginate(5);
        return view('account',['collections'=>$accounts]);
    }

    function addAccount(Request $req){
        $account = new AccountModel;
        $account->fullName= $req->fullName;
        $account->age= $req->age;
        $account->userName= $req->userName;
        $account->password= $req->password;
       $account->save(); 
       return redirect('userAccounts');
    }

    function deleteAccount($id){
        $data = AccountModel:: find($id);
        $data->delete();
        return back()->with('success','Account deleted successfully!');
        return redirect('userAccounts');
    }

    function editAccount($id){
        $data = AccountModel::find($id);
        return view('editAccount',['collection'=>$data]);
    }

    function editInfo(Request $req){
        // return $req->input();
        $data = AccountModel::find($req->id);
        $data->fullName= $req->fullName;
        $data->age= $req->age;
        $data->userName= $req->userName;
        $data->password= $req->password;
       $data->save(); 
       
       return redirect('userAccounts');
    }

    function joinExample (){
        // return DB::table('employees')->get();  
        return DB::table('employees')
        ->join('userAccounts','employees.empId','=','userAccounts.id')
        ->select('employees.*')
        ->where('employees.position','Head of Security')
        ->get();
    }
}
