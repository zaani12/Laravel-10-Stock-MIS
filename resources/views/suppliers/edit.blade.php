@extends('layouts.app')
@section('contents')
    <h1 class="mb-0">Edit {{$supplier->fullName}} Infromation</h1>
    <hr />
    <form action="{{ route('suppliers/update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">supplier Name</label>
                <input type="text" name="fullName" class="form-control" placeholder="fullName" value="{{ $supplier->fullName }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Email address</label>
                <input type="text" name="email" class="form-control" placeholder="unitPrice" value="{{ $supplier->email }}" >
            </div>
           
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label"> Address</label>
                <input type="text" name="address" class="form-control" placeholder="address" value="{{ $supplier->address }}" >
            </div>   
            <div class="col mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="phone" value="{{ $supplier->phone }}" >
            </div>      
        </div>
        <div class="row">
            <div class="d-grade m-2">
                <button class="btn btn-primary ">Update</button>
            </div>
            <div class="d-grade m-2">
                <a href="{{ url()->previous() }}" class="btn btn-primary ">Back</a>
            </div>
        </div>
    </form>
@endsection