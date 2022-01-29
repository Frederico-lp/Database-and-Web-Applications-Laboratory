@extends('home.best_rated')


@section('orderedPrice')

    <br>
    <div>
        <h1>Best Deals
        <a type="button"  class="btn btn-secondary" href="{{ url('/books-price') }}">See more</a></h1>
    </div>
    <section id="books">

        @foreach($books->sortBy('price') as $book)
                @if($loop->index == 6)
                    @break
                @endif
                @include('partials.book',$book)

        @endforeach


    </section>
    <br>


@endsection
