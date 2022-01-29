@extends('layouts.app')

@section('content')

	<br>
	<div class="text">
		<h1>Cart</h1>
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
			<br>
			<div id = "remove">
				<form action="cart/{{ $book->bookid }}/delete" method="POST">
					@method('delete')
					@csrf
					<div>
						<button type="submit" class="btn btn-secondary">Remove</button>
					</div>
				</form>
			</div>	
		</article>
		@endforeach
	</div>

	<br>
	<div id = "checkout">
		<a class="btn btn-primary" style = "size:100px;"href="cart/checkout">checkout</a>
	</div>
	





@endsection
