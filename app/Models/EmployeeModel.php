<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;
    public $table = 'employees';
    public function getSalaryAttribute($value){
        return $value . " Afg";
    }

    public function setFullNameAttribute($value){
        $this->attributes['fullName']= "Mr. " . $value;
    }

    public function setPositionAttribute($value){
        $this->attributes['position']= $value . " !";
    }

    public function getUserAccounts(){
        return $this->hasOne('App\Models\AccountModel');
    }
}
