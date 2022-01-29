@extends('layouts.app')
@section('content')

@foreach($errors as $error)
	<div class="col-12">
		<div class = "alert alert-danger">
			<i class="fa fa-times"></i>
			{{$error}}
		</div>
	</div>
@endforeach

<div class="text"> 
    <h1>Checkout</h1>
    <h2>Order Details: </h2>

</div>



<div class="cart-books">
		@foreach($bookIds as $book)


		<article class="book" data-id="{{ $book->bookid }}">

			<div class="text">
				<a href="/api/books/viewBook/{{ $book->bookid }}">
					<img src="{{$book->bookContentid($book->bookid($book->bookid)->bookcontentid)->bookcover}}" 
						width="200" height="250" ></a>
						
				
				<h2><a href="/api/books/viewBook/{{ $book->bookid }}" > {{ $book->bookContentid($book->bookid($book->bookid)->bookcontentid)->title }}</a></h2>
				<p> {{ $book->bookid($book->bookid)->price }}€</p>
				<p1>Quantity: {{ $book->quantity }}</p1>

			</div>
		</article>
		@endforeach
</div>

<div>
       <h2>Credit Card(s): </h2>
		@foreach($creditCard as $card)
		<br>
		<div class="information" style = "margin-left:1%; padding-left:5%"> 

		<p>Name: {{$card->ownername}}</p>
		<p>Number: {{$card->cardnumber}}</p>
		<p>Security code: {{$card->securitycode}}</p>
		<br><br>
</div>
<br>
		@endforeach
</div>        
<a href="/user/{{$user->id}}/payment-methods/add" class="btn btn-primary" >Add Payment Method</a>
<br>
<div id = "checkout">
        <form action="checkout/confirmed" method="POST">
            {{ csrf_field() }}
            {{ method_field('put') }}
			<label>Select card</label>
			<select class="form-select w-50" name="cardNumber">
				@foreach($creditCard as $card)
				<option value="{{$card->cardnumber}}">{{$card->cardnumber}}</option>
				@endforeach
			</select>
			<br>
			<br>
            <button  type="submit" class="btn btn-primary">Confirm</button>
			<br>
		</form>
		<br>
		<br>
		<br>


</div>

@endsection
