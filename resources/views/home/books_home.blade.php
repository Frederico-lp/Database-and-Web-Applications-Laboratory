@extends('home.home')


@section('listingNormal')

<div id="listing-books">
    <div>
        <h1>New in
        <a type="button"class="btn btn-secondary" href="{{ url('/books-id') }}">See more</a></h1>
    </div>
    
    <section id="books">

    @foreach($books as $book)
       
        @if($loop->index == 6)
           @break
        @endif
                
        @include('partials.book',$book)
    @endforeach


    </section>
<br>

@yield('bestRated')

</div>


@endsection
