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
                <input type="number" name="quantity" class="form-control" placeholder="Product Quantity">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="supplier" placeholder="Supplier Name"/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="file" class="form-control" name="file" placeholder="Product Photo"/>
            </div>
        </div>
 
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection