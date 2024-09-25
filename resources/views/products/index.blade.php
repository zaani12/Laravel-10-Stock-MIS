@extends('layouts.app')
@include('cdn')
@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Products List</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Add Product
    </a>
</div>
<hr />
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Register Date</th>
            <th>Supplier</th>
            <th>Photo</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @if($product->count() > 0)
            @foreach($product as $counter)
                <tr>
                    <td class="align-middle">{{ $counter->id }}</td>
                    <td class="align-middle">{{ $counter->productName }}</td>
                    <td class="align-middle">{{ $counter->unitPrice }}</td>
                    <td class="align-middle">{{ $counter->quantity }}</td>
                    <td class="align-middle">{{ $counter->registerDate }}</td>
                    <td class="align-middle">{{ $counter->supplier }}</td>
                    <td class="align-middle">
                        @if($counter->photo)
                            <img src="{{ asset('storage/' . $counter->photo) }}" width="50px" alt="Product Image">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('products.show', $counter->id) }}" class="btn">
                        <i class="fa fa-list"></i>
                    </a>
                    <a href="{{ route('products.edit', $counter->id)}}" class="btn">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('products.destroy', $counter->id) }}" method="POST" onsubmit="return confirm('The product would be deleted! \n Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn m-0"><i class="fa fa-trash"></i></button>
                    </form>

                    <form action="{{ route('products.sell', $counter->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <div class="mb-3">
                            <label for="quantity{{ $counter->id }}" class="form-label">Quantity to Sell</label>
                            <input type="number" name="quantity" id="quantity{{ $counter->id }}" class="form-control" min="1" max="{{ $counter->quantity }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Confirm Sale</button>
                    </form>
                </div>
            </td>
        </tr>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="8">No products found</td>
            </tr>
        @endif
    </tbody>
</table>

<div>
    <span class="pagination">
        {{ $product->links('pagination::bootstrap-5') }}
    </span>
</div>
@endsection
