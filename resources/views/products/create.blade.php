@extends('layouts.app')

@section('contents')
    <h1 class="mb-0">Add New Product</h1>
    <hr />
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <input type="text" name="productName" class="form-control" placeholder="Product Name">
        </div>
        <div class="col">
            <input type="number" name="unitPrice" class="form-control" placeholder="Price">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <input type="number" name="quantity" class="form-control" placeholder="Quantity">
        </div>
        <div class="col">
            <input type="text" name="supplier" class="form-control" placeholder="Supplier">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <input type="file" name="file" class="form-control" placeholder="Product Image">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <input type="date" name="registerDate" class="form-control" placeholder="Register Date">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
