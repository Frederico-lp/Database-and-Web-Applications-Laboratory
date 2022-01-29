
@extends('user.profile')

@section('action')

        <h1> Profile</h1>
            <div class= "profile-info">
                <div class= "photo-name">
                    <img src = {{ $user->profilepicture }} width="260" >
                    <figcaption>{{ $user->name }} </figcaption>
                </div>
                <div class="space"></div>
                <div class= "information" style = "height: 350px;"
>
                    <h1> Account Details: </h1><hr>
                    <p2>  Username:</p2> <p3>  {{ $user->name }} </p3><hr>
                    <p2>  Email: </p2> <p3>  {{ $user->email }}</p3><hr>


                </div>


        </div>


@endsection