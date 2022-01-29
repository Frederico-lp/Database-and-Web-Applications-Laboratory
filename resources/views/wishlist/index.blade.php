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
			<h1>Wishlist</h1>
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

			</div>

			<div id = "remove">
			<form action="wishlist/{{ $book->bookid }}/delete" method="POST">
					@method('delete')
					@csrf
					<div>
						<button type="submit" class="btn btn-primary">Remove</button>
					</div>
				</form>
			</div>	
		</article>
		@endforeach
	</div>


@endsection
