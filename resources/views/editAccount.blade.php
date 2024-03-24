
@extends('layouts.app')
@section('contents')
    <h1 class="mb-0">Edit {{$collection->userName}}</h1>
    <hr />
    <form action="/edit" method="POST">
        @csrf
        <div class="row">
            <div class="col mb-3">
                <input type="hidden" name="id" value="{{$collection->id}}"/>
                <label class="form-label">User Name</label>
                <input type="text" name="userName" class="form-control"value="{{ $collection->userName }}" >
            </div>
            
            <div class="col mb-3">
                <label class="form-label">Employee Full name</label>
                <input type="text" name="fullName" class="form-control" placeholder="fullName" value="{{ $collection->fullName }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">collection Supplier</label>
                <input type="text" name="age" class="form-control" placeholder="age" value="{{ $collection->age }}" >
            </div>  
            <div class="col mb-3">
                <label class="form-label">submit edition</label>
                <button class="form-control btn btn-primary">Update</button>
            </div>
        </div>
       
    </form>
@endsection