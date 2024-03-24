<!-- <h1>Users view file </h1> -->

<!-- @include('innerUserView') -->
@include('header')

<h1 style="text-align: center;">Login form</h1>
<form action="users" method="POST" style="text-align: center;">
  @csrf
  <!-- {{$errors}}<br /> -->
  <!-- @if ($errors->any())
      @foreach ($errors->all() as $err)
<li style="color: red;">{{$err}}</li>        
      @endforeach
  @endif -->
  <input type="text" name="userName" placeholder="Enter your user name please" /><br />
  <span style="color: red;">@error('userName')
    {{$message}}
  @enderror</span><br/>
  <input type="password" name="password" placeholder="Enter the password" /><br />
  <span style="color: red;">@error('password')
    {{$message}}
  @enderror</span><br/>
  <input type="submit" value="Login" />
</form>

@include('footer')