@extends('layouts.app')

@section('content')
<br>
<h1 >Payment Methods </h1>
<br>
@foreach($creditCards as $creditCard)
<div class="information" style = "margin-left:5%; padding-left:5%"> 
    <br>
    <p> Name: {{ $creditCard->ownername }}</p>
    <p> Card Number: {{ $creditCard->cardnumber }} </p>
    <p> Security Code: {{ $creditCard->securitycode }} </p>
    <br>
      <form action="/user/{{$creditCard->userid}}/payment-methods/{{$creditCard->cardid}}/delete" method="POST">
        @method('delete')
        @csrf
        <div>
          <button type="submit" class="btn btn-primary" >Remove</button>
        </div>
      </form>

    <a href="/user/{{$creditCard->userid}}/payment-methods/{{$creditCard->cardid}}/edit" class="btn btn-primary" >Edit</a>
 <br> <br>
</div>
  <br>
@endforeach
<a style = "margin-left:10%;"href="/user/{{$userid}}/payment-methods/add" class="btn btn-primary" >Add Payment Method</a>
@endsection