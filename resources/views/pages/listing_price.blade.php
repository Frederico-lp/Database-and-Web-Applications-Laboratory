@extends('layouts.app')

@section('content')

<section id="listing-books">
  <br><br>
  <h1>Best Deals</h1>
  <section id="books">

      @each('partials.book', $books->sortby('price'), 'book')

  </section>

  <br><br>
  {{ $books->links() }}
  <br><br>

</section>
</section>

@endsection
