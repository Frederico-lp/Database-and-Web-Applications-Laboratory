@extends('layouts.app')

@section('content')

<h1 class="text"> Edit Credit Card </h1>

<div class="text">
    <form action="edit/update" method="POST">
        @method('PUT')
        @csrf
        <label for="ownername">Owner Name:</label><br>
        <input type="text"  name="ownername"><br>
        <label for="cardnumber">Card Number:</label><br>
        <input type="text"  name="cardnumber">
        <label for="securitycode">Security Code:</label><br>
        <input type="text"  name="securitycode">
        <button type="submit" class="btn btn-primary" >Add</button>
    </form>
</div>

@endsection