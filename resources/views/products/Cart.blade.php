@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Your Cart</h1>

    @if(Session::has('cart') && count(Session::get('cart')) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Image</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
            @endphp
            @foreach(session('cart') as $id => $details)
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>${{ $details['price'] }}</td>
                <td>{{ $details['quantity'] }}</td>
                <td>${{ $details['price'] * $details['quantity'] }}</td>
                <td>
                    <img src="{{ asset('storage/' . $details['photo']) }}" alt="{{ $details['name'] }}" style="height: 50px; width: auto;">
                </td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="GET">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE"> <!-- Simulate DELETE method -->
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @php
                $totalAmount += $details['price'] * $details['quantity'];
            @endphp
            @endforeach
        </tbody>
    </table>

    <!-- Total Amount -->
    <div class="d-flex justify-content-end">
        <h4>Total Amount: ${{ $totalAmount }}</h4>
    </div>

    <!-- Confirm Sale Button -->
    <form action="{{ route('cart.confirm') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Confirm Sale</button>
        <!-- PDF Invoice Button -->
        <a href="{{ route('cart.pdf') }}" class="btn btn-primary">Download PDF Invoice</a>
    </form>

    @else
    <p>No items in cart</p>
    @endif
</div>
@endsection
