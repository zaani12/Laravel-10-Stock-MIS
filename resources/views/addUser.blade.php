@extends('layouts.app')
@section('contents')
      <h1 class="mb-0">Add New User Account</h1>
      <hr />
      <form action="addAccount" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
              <div class="col">
                  <input type="text" name="userName" class="form-control" placeholder="User Name">
              </div>
              <div class="col">
                  <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
          </div>
          <div class="row mb-3">
              <div class="col">
                  <input type="text" name="fullName" class="form-control" placeholder="Emplloyee Full name">
              </div>
              <div class="col">
                  <input type="number" class="form-control" name="age" placeholder="Age"/>
              </div>
          </div>
       
          <div class="row">
              <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Insert</button>
              </div>
          </div>
      </form>
  @endsection