@extends('layouts.app')
  
@section('contents')
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
<div class="row">
    <div class="col-md-5">
        <h1 class="mb-0">Profile Photo</h1>
    </div>
    <div class="col-md-7">
        <img src="storage/{{ auth()->user()->photo }}"class="rounded-circle" width="150px" height="150px"/>
    </div>
</div>
    <hr />
 
    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm"
          action="{{route('profileSetting', auth()->user()->id)}}" >
    @csrf
    <div class="row">
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row" id="res"></div>
                <div class="row mt-2">
  
                    <div class="col-md-4">
                        <label class="labels">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="col-md-4">
                        <label class="labels">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="col-md-4">
                        <label class="labels">Access Level</label>
                        <input type="text" name="level" disabled class="form-control" value="{{ auth()->user()->level }}">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label class="labels">Profile Photo</label>
                        <input type="file" name="file" class="form-control" value="{{ auth()->user()->photo }}">
                    </div>
                    <div class="col-md-4">
                        <label class="labels">Created Date</label>
                        <input type="text" name="created_at" class="form-control" disabled placeholder="created_at" value="{{ auth()->user()->created_at }}">
                    </div>
                    <div class="col-md-4">
                        <label class="labels">Latest Modification Date</label>
                        <input type="text" name="updated_at" class="form-control" disabled value="{{ auth()->user()->updated_at }}" placeholder="updated_at">
                    </div>
                </div>
                 
                <div class="mt-5 text-center">
                    <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </div>
        </div>
         
    </div>   
            
        </form>
@endsection