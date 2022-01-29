@extends('layouts.app')



@section('content')
<br><br><br>

<div id = "delete">
    <form action="delete/confirmed" method="POST">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <label>Are you sure you want to delete your account?</label>
        <button  type="submit" class="btn btn-primary">Confirm</button>
</form>

@endsection
