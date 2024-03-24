@extends('layouts.app')
@include('cdn')
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">User Accounts list</h1>
        <a href="addAccount" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New Account</a>
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
                <th>Age</th>
                <th>UserName</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>+
            @if($collections->count() > 0)
                @foreach($collections as $counter)
                    <tr>
                        <td class="align-middle">{{ $counter->id }}</td>
                        <td class="align-middle">{{ $counter->fullName }}</td>
                        <td class="align-middle">{{ $counter->age }}</td>
                        <td class="align-middle">{{ $counter->userName }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-light " href={{"edit/".$counter['id']}}><i class="fa fa-edit"></i></a>
                                <a class="btn btn-light" href={{"delete/".$counter['id']}}><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="8">User account not found</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div>
        <span class="pagination">
            {{ $collections->links('pagination::bootstrap-5') }}
        </span>
    </div>
@endsection
