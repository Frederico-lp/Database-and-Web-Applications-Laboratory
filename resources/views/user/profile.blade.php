@extends('layouts.app')



@section('content')
<br><br><br>
 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/user/{{$user->id}}">Account</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link active" href="/user/{{$user->id}}">User Profile
                <span class="visually-hidden">(current)</span>
            </a>
            </li>
                <li class="nav-item">
                <a class="nav-link" href=" /user/{{ $user->id }}/edit">Edit Profile</a>
            </li>
            </li>
                <li class="nav-item">
                <a class="nav-link" href=" /user/{{ $user->id }}/payment-methods">Payment methods</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=" /user/{{ $user->id }}/review-history"> Review history</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=" /user/{{ $user->id }}/purchase-history"> Purchase history</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href = " /user/{{ $user->id }}/confirm-delete"> Delete account </a>
            </li>
        </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
        <br>

            @yield('action')        
        
        <br><br>
    </div>
    </div>
                   
                         

@endsection
