@extends('layouts.app')
@include('cdn')
@section('contents')

<div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0"> Suppliers list</h1>
        <a href="{{route('suppliers/create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New Supplier</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>+
        @if($suppliers->count() > 0)
        @foreach ($suppliers as $supplier)
        <tr>
            <td class="align-middle">{{$supplier->id}}</td>
            <td class="align-middle">{{$supplier->fullName}}</td>
            <td class="align-middle">{{$supplier->email}}</td>
            <td class="align-middle">{{$supplier->phone}}</td>
            <td class="align-middle">{{$supplier->address}}</td>
            <td class="align-middle">
                <a href="{{route('suppliers/edit',$supplier->id)}}"><i class="fa fa-edit"></i></a> &nbsp; &nbsp;
                <a 
                href="{{route('suppliers/delete',$supplier->id)}}"
                onclick="return confirm('The supplier would be deleted! \n Are you sure?')"
                ><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="8">Suppliers not found</td>
        </tr>
        @endif
    </tbody>
</table>

@endsection