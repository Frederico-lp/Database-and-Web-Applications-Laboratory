<article class="book" data-id="{{ $book->bookid }}">
    <a href="/api/books/viewBook/{{ $book->bookid }}">
    <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
    class="float-left" width="160" height="230"> </a>
    


    <a href="/api/books/viewBook/{{ $book->bookid }}"><h3>{{  $book->bookContent()->get('title')[0]->title }}</h3></a>
        
    <div >
        <p> Written by {{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}</p> 
        <p1 style = "color :#860b05;">{{ $book->price }}€</p1>
    </div>
</article>
