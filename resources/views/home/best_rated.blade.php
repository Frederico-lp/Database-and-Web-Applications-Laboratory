@extends('home.books_home')


@section('bestRated')

    <div>
        <h1>Public favorites
        <a type="button" class="btn btn-secondary" href="{{ url('/books-rating') }}">See more</a></h1>
    </div>
    <section id="books">

        @foreach($books->sortByDesc(function ($book) {
                    $bookContent = $book->bookid($book->bookcontentid);

                    return $bookContent->average;
                }); as $book)
            @if($loop->index == 6)
                @break
            @endif

            @include('partials.book',$book)
            
        @endforeach


    </section>

    @yield('orderedPrice')

@endsection
