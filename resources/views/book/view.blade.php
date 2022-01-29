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
 

    <div id = "bookpage">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
            width="400" height="500"> 

        <div class="text">

            <h1> {{ $book->bookContent()->get('title')[0]->title }} 
            <p style=" padding-left:10px;">  by {{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}</p> </h1>
            <p>Edition: {{ $book->edition }}</p>
            <p>Book Type: {{ $book->booktype }}</p>
            <p>Publisher: {{ $book->publisher }}</p>
            <p>Categories: </p>
            @foreach($categories as $category)
            <p> - {{$category}} </p>
            @endforeach
            <div style="font-size: 50px; padding-left:30px; padding-top: 5px;">
            @for($i = 0 ; $i < $book->bookContent->average; $i++)
                <span class="fa fa-star checked"></span>
            @endfor
            @for( $i = 1 ; $i < 6 - $book->bookContent->average; $i++)
                <span class="fa fa-star"></span>
            @endfor
            </div>
            <h2 style="padding-bottom:0px ;">Synopsis</h2>
            <p> {{$book->bookContent()->get('description')[0]->description}}</p>

            


            
        </div>
        <div id ="price-buttons">
                <h2>{{ $book->price }}€</h2>

                <div>
                    
                    <form action="{{$book->bookid}}/add-to-cart" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="block">
                            <input 
                                type="number" value = 1 min=1
                                name="quantity">
                    <button type="submit"  class="btn btn-primary" >Add to Cart</button>
                </div>
                    </form>
                <br>
                <div id="wish">
                        <form action="{{$book->bookid}}/add-to-wishlist" method="POST">
                            @method('PUT')
                            @csrf
                            <button  type="submit"  class="btn btn-primary" >Add to WishList</button>
                        </form>
                </div>



            </div>
            <br>

            @if (Auth::check())
                        @if (Auth::user()->isadmin == 'True')
                        <a style ="margin-left: 86px ; width: 150px;" class="btn btn-primary" href="/api/books/viewBook/{{$book->bookid}}/edit"> Edit Book </a>
                        @endif
                    @endif


        </div>

    </div>



    <div id = "reviews">
         @yield('reviews');
    </div>
    

   




@endsection
