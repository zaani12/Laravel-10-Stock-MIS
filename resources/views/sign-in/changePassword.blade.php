@extends('layouts.app')
@include('cdn')
@section('contents')
    <h1 class="mb-0"> Changing Password </h1>
    <hr />
<form method="POST" action="{{ route('changePassword') }}">
    @csrf
    @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                      </div>
                    @endif
    <div class="row">
        <label for="current_password">Current Password</label>
        <input id="current_password" type="password" name="current_password" class="form-control" >
    </div>

    <div class="row">
        <div class="col-xl-6">

            <label for="password">New Password</label>
            <input id="password" type="password" name="password" class="form-control "  >
        </div>
        <div class="col-xl-6">

            <label for="password_confirmation">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"  >
        </div>
    </div>
    <hr/>
        <button type="submit" class="btn btn-primary">Change Password</button>

</form>
@endsection