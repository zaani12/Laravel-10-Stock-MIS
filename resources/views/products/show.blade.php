@extends('layouts.app')
@section('contents')
    <h1 class="mb-0">Details of {{$product->productName}}</h1>
    <hr />
    <div class="row">
        <div class="col-xl-9">

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="productName" class="form-control"value="{{ $product->productName }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Price</label>
            <input type="text" name="unitPrice" class="form-control"  value="{{ $product->unitPrice }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Quantity</label>
            <input type="text" name="quantity" class="form-control"  value="{{ $product->quantity }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Register Date</label>
            <input type="text" name="registerDate" class="form-control" value="{{ $product->registerDate }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Supplier</label>
            <input type="text" class="form-control" name="supplier" value="{{$product->supplier }}" readonly/>
        </div>
       
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $product->updated_at }}" readonly>
        </div>
    </div>
    </div>
        <div class="col-xl-3">
        <div class="col mb-3">
            <img src="{{ asset('storage/' . $product->photo) }}" width="90%" alt="Product Photo">
        </div>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-primary form-control col-xl-9">Back</a>
@endsection