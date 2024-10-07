@extends('layouts.app')
@include('cdn')

@section('contents')

<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Products Store</h1>
    <a href="{{ route('cart.index') }}" class="btn btn-primary">
        <i class="fa fa-shopping-cart"></i> View Cart
    </a>
</div>

<hr />

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

<!-- Display Products in a Card Grid Layout -->
<div class="row">
    @if($product->count() > 0)
        @foreach($product as $item)
        <div class="col-md-3 mb-4"> <!-- Bootstrap column with margin bottom -->
            <div class="card h-100"> <!-- Use h-100 for equal height cards -->
                <!-- Product image with Bootstrap's responsive class -->
                <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('default-image.png') }}" class="card-img-top" alt="{{ $item->productName }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column"> <!-- Use flex-column for layout -->
                    <h5 class="card-title">{{ $item->productName }}</h5>
                    <p class="card-text">
                        <strong>Price: </strong> ${{ $item->unitPrice }} <br>
                        <strong>Supplier: </strong> {{ $item->supplier }} <br>
                        <strong>Quantity: </strong> {{ $item->quantity }}
                    </p>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('products.addToCart', $item->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <div class="mb-3">
                            <label for="quantity{{ $item->id }}" class="form-label">Quantity to Sell</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('quantity{{ $item->id }}').stepDown()">-</button>
                                <input type="number" name="quantity" id="quantity{{ $item->id }}" class="form-control" min="1" max="{{ $item->quantity }}" value="0" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('quantity{{ $item->id }}').stepUp()">+</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <div class="col-12">
        <p class="text-center">No products found</p>
    </div>
    @endif
</div>

@endsection
