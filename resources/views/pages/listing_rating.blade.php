@extends('layouts.app')

@section('content')

<section id="listing-books">
  <br><br>
  <h1>Public Favorites</h1>
  <section id="books">

      @each('partials.book', $books->sortByDesc(function ($book) {
                    $bookContent = $book->bookid($book->bookcontentid);

                    return $bookContent->average;
                }), 'book')

  </section>

</section>

@endsection
