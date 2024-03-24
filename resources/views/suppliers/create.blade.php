@extends('layouts.app')
  
@section('contents')
    <h1 class="mb-0">Add New Supplier</h1>
    <hr />
    <form action="{{ route('suppliers/store') }}" method="POST" >
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="fullName" class="form-control" placeholder="Supplier Name">
                @error('fullName')
                    <span class=" text-danger">{{ $message }}</span>
                  @enderror
            </div>
            <div class="col">
                <input type="text" name="email" class="form-control" placeholder="Email Address">
                 @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="phone" class="form-control" placeholder="Supplier contact">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>
            <div class="col">
                <input type="text" class="form-control" name="address" placeholder="Supplier Address"/>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>
        </div>
 
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Insert</button>
            </div>
        </div>
    </form>
@endsection