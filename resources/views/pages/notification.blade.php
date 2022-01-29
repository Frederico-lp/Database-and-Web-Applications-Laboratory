@extends('layouts.app')

@section('content')

<br>
<h1 > Notifications </h1>
<br>
@foreach($notifications as $notification)
  <div class="information" style = "margin-left:5%;"> 
    <br>
    @if ($notification->orderid != null)
    <p> {{ $notification->notificationmessage }} on ordered Book "{{ $notification->getBookContent($notification->getBookProduct($notification->bookid)->bookcontentid)->title }}"</p>
    <p> Time: {{ date('d-m-Y    g:i a', strtotime($notification->notificationtime)) }} </p>
    <a class="btn btn-primary"href=" /user/{{ $notification->userid }}/purchase-history"> View Order </a> 
    @endif
    
    @if ($notification->creditcardid != null)
    <p> {{ $notification->notificationmessage }} </p>
    <p> Time: {{ date('d-m-Y    g:i a', strtotime($notification->notificationtime)) }} </p>
    <a class="btn btn-primary" href=" /user/{{ $notification->userid }}/payment-methods"> View Payment Methods </a> 
    @endif

    @if ($notification->creditcardid == null && $notification->orderid == null)
    <p> {{ $notification->notificationmessage }} </p>
    <p> Time: {{ date('d-m-Y    g:i a', strtotime($notification->notificationtime)) }} </p>
    <a class="btn btn-primary" href=" /api/books/viewBook/{{ $notification->bookid }}"> View Book </a> 
    @endif
    <br><br>
  </div>
  <br>
@endforeach

@endsection