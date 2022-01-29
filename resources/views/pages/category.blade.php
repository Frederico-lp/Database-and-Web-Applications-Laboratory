@extends('layouts.app')

@section('content')

<section id="listing-books">
  <br><br>
  <h3>{{ $category->label}}</h3>
  <section id="books">

      @each('partials.book', $books, 'book')

  </section>

</section>

@endsection
