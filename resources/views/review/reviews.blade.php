@extends('book.view')

@section('reviews')


<div class="text">
  <h1> Reviews </h1>
</div>
@if(Auth::check())

  <div id = "comment">
  <div class = "profile-comment">
            <div class = "profile-comment">
              <img src = {{ Auth::getUser()->profilepicture}} width="100" border-radious = "50%" >
              <p>  {{ Auth::getUser()->name}} </p>
            </div>
      </div>
      <div class = "comment-content">
        <br>

          <form action="{{ $book->bookid}}/addReview/add-to-reviews" method="POST">
              @method('PUT')
              @csrf
              <label for="rating">Rating:</label>
              <input type="number" value = 1 min=1 max=5
                                  name="rating" >
                                  <br><br>

              <input type="text"  name="comment" style = "height:80px; width: 400px;">
              <button type="submit" class="btn btn-primary" >Post</button>
          </form>
      </div>
      <br>
  </div>
@endif

<br>
@foreach($reviews->sortByDesc('orderid') as $review)


  <div id = "comment">

   
    <div class = "profile-comment">
      <img src = {{ $review->getUser($review->userid)->profilepicture }} width="100" border-radious = "50%" >
      <p>  {{ $review->getUser($review->userid)->name }} </p>
    </div>

    <div class = "comment-content">
      <div style="font-size: 30px; padding-top: 5px;">
      @for($i = 0 ; $i<$review->rating; $i++)
        <span class="fa fa-star checked"></span>
      @endfor
      @for( $i = 0 ; $i < 5 - $review->rating; $i++)
        <span class="fa fa-star"></span>
      @endfor
      </div>
      <p> {{ $review->reviewcomment }}</p>
      @if (Auth::check() && $review->userid === Auth::id())
      <div>
        <form action="/user/{{ $review->userid }}/review-history/{{ $review->reviewid }}/delete" method="POST">
          @method('delete')
          @csrf
          <div>
            <button  style = " display: inline-block; float:left;"type="submit" class="btn btn-primary">Remove</button>
          </div>
        </form>

        <a style="display: inline-block;"
          href="/user/{{ $review->userid }}/review-history/{{ $review->reviewid }}/edit" class="btn btn-primary">Edit</a>
      </div>

      @endif
      <br>

</div>
    

      
  </div>
  <br>
  @endforeach


@endsection