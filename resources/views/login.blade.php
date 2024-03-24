@include('header')
<h1 style="text-align: center;">Login form</h1>
<form action="formLogin" method="POST" style="text-align: center;">
<!-- {{method_field('PUT')}} -->
  @csrf
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