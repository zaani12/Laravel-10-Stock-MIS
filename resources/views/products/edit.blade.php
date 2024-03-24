@extends('layouts.app')
@section('contents')
    <h1 class="mb-0">Edit {{$product->productName}}</h1>
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="productName" class="form-control" placeholder="productName" value="{{ $product->productName }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="unitPrice" class="form-control" placeholder="unitPrice" value="{{ $product->unitPrice }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Quantity</label>
                <input type="text" name="quantity" class="form-control" placeholder="quantity" value="{{ $product->quantity }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Product Supplier</label>
                <input type="text" name="supplier" class="form-control" placeholder="supplier" value="{{ $product->supplier }}" >
            </div>

            <div class="col mb-3">
                <label class="form-label">Product photo</label>
                <input type="file" name="file" class="form-control"value="{{ $product->photo }}" >
            </div>
            
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection