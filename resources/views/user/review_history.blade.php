@extends('layouts.app')

@section('content')
<br><br>

<h3>Reviews </h3>
<br>

@if(! $reviews->isEmpty())
  @foreach($reviews as $review)
    <div id = "comment">

      
    <div class = "profile-comment">
      <img src = {{ $review->getUser($review->userid)->profilepicture }} width="100" border-radious = "50%" >
      <p>  {{ $review->getUser($review->userid)->name }} </p>
    </div>

    <div class = "comment-content">
      <div style="font-size: 30px; padding-top: 5px;">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star "></span>
        <span class="fa fa-star"></span>
      </div>
      <p> {{ $review->reviewcomment }}</p>
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

      <br>

    </div>
    <br>

    </div>
        <br>

    @endforeach


@else
 <p>No reviews</p>
 @endif

@endsection