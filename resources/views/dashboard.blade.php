@extends('layouts.app')

@section('title', 'Admin Dashboard for Stock Management System')
@include('cdn')
@section('contents')
  
@if(Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('status') }}
        </div>
@endif

  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
         <div class="row">
         <div class="col-xl-7 col-lg-7">
            
            <h5 class="card-title">Products</h5>
            <p class="card-text">Products amount : 8</p>
            <a href="{{ route('products') }}" class="btn btn-primary">Go to Products</a>
          
            </div>
            <div class="col-xl-5 col-xl-5 ">
              <i class="fa fa-6x fa-shopping-cart text-primary"></i>
            </div>
         </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
        <div class="row">
         <div class="col-xl-7">
            
            <h5 class="card-title">Employees</h5>
            <p class="card-text">Employees Amount: 5</p>
            <a href="fetchEmployees" class="btn btn-primary">Go to Employees</a>
          
            </div>
            <div class="col-xl-5">
              <i class="fa fa-6x fa-users text-primary"></i>
            </div>
         </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
        <div class="row">
         <div class="col-xl-7">
            
            <h5 class="card-title">User Accounts</h5>
            <p class="card-text">User Accounts Amount : 1</p>
            <a href="userAccounts" class="btn btn-primary">Go to User Accounts</a>
          
            </div>
            <div class="col-xl-5">
              <i class="fa fa-6x fa-lock text-primary"></i>
            </div>
         </div>
        </div>
      </div>
    </div>
  
    
  </div>
@endsection