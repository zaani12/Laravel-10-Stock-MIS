@extends('layouts.app')
@include('cdn')
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Employees list</h1>
        <a href="" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Employee</a>
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
                <th>Full Name</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Age</th>
                <th>User-Name</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>+
            @if($collection->count() > 0)
                @foreach($collection as $counter)
                    <tr>
                        <td class="align-middle">{{ $counter->id }}</td>
                        <td class="align-middle">{{ $counter->fullName }}</td>
                        <td class="align-middle">{{ $counter->position }}</td>
                        <td class="align-middle">{{ $counter->salary }}</td>
                        <td class="align-middle">{{ $counter->age }}</td>  
                        <td class="align-middle">{{ $counter->userName }}</td>  
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-light " href=""><i class="fa fa-edit"></i></a>
                                <a class="btn btn-light" href=""><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="8">Employee not found</td>
                </tr>
            @endif
        </tbody>
    </table>
   
@endsection