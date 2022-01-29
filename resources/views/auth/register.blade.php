@extends('layouts.app')

@section('content')
<br><br>
<div class="information" style = "padding-left: 10%; margin-left: 1%; 
">
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="form-group">
    <label class="col-form-label mt-4" for="inputDefault">Name</label>
    <input type="text" class="form-control" placeholder="Name" name = "name"  value="{{ old('name') }}" id="inputDefault" required autofocus style = "width: 60%;">
  </div>

    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }}
      </span>
    @endif
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
    <div class="form-group" >
      <label for="exampleInputPassword1" class="form-label mt-4"> Confirm Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password_confirmation" required style = "width: 60%;">

  <br>
    <button type="submit" class ="btn btn-primary" >
      Register
    </button>
    <a class="btn btn-primary"  href="{{ route('login') }}">Login</a>
<br></form>
<br>
@endsection
