<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;

class EmployeeController extends Controller
{
    function fetchData (){
        // $collection = EmployeeModel::all();

        $collection = EmployeeModel::join('userAccounts', 'employees.empId', '=', 'userAccounts.empId')
        ->get();

        // $collection = EmployeeModel::find(1)->getUserAccounts;
        // return view('employees',['collection'=>$collection['data']]);
        return view('employees', compact('collection'));
    }
}
