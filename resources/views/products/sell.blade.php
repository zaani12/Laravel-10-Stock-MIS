@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Sell Product: {{ $product->productName }}</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control" value="{{ $product->unitPrice }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Available Quantity</label>
            <input type="text" class="form-control" value="{{ $product->quantity }}" readonly>
        </div>
    </div>
    <form action="{{ route('products.sell.confirm', $product->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity to Sell</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $product->quantity }}" required>
        </div>
        <button type="submit" class="btn btn-success">Confirm Sale</button>
    </form>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
</div>
@endsection
