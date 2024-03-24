@extends('layouts.app')
@include('cdn')
@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Products list</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Add Product</a>
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
            <th>Price
                <a href="{{ route('products', ['sort' => 'unitPrice', 'direction' => 'asc']) }}">
                     <i class="fa fa-arrow-up"></i>
                </a>
                <a href="{{ route('products', ['sort' => 'unitPrice', 'direction' => 'desc']) }}">
                     <i class="fa fa-arrow-down"></i>
                </a>
            </th>
            <th>Quantity</th>
            <th>Register Date</th>
            <th>Supplier</th>
            <th>Photo</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>+
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

                <img src="{{ asset('storage/' . $counter->photo) }}" width="50px" alt="Product Photo">
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('products.show', $counter->id) }}" type="button" class="btn ">
                        <i class="fa fa-list"></i></a>
                    <a href="{{ route('products.edit', $counter->id)}}" type="button" class="btn ">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('products.destroy', $counter->id) }}" method="POST" type="button" class="btn p-0 " onsubmit="return confirm('The product would be deleted! \n Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn m-0 "><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="8">Product not found</td>
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