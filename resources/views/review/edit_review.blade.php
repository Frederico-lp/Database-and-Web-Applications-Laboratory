@extends('layouts.app')

@section('content')

<h1 class="text"> Edit Review </h1>

<div class="text">
    <form action="edit/update" method="POST">
        @method('PUT')
        @csrf
        <label for="rating">Rating:</label><br>
        <input type="text"  name="rating"><br>
        <label for="comment">Description:</label><br>
        <input type="text"  name="comment">
        <button type="submit" class="btn btn-primary" >Add Changes</button>
    </form>
</div>

@endsection