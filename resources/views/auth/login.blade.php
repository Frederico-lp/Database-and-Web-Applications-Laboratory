@extends('layouts.app')

@section('content')
<br><br>
<div class="information" style = "padding-left: 10%; margin-left: 1%; 
">
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <br>
    <div class="form-group" >
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" name = "email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Enter email" style = "width: 60%;">
      @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group" >
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required style = "width: 60%;">
      @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif
    </div>
    
<br>
    <label >
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>
<br>
    <button  class = "btn btn-primary" type="submit">
        Login
    </button>
    <a class="btn btn-primary"  href="{{ route('register') }}">Register</a>
</form>
<br><br>
</div>

<br><br>
@endsection
