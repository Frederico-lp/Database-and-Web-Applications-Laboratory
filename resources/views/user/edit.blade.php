@extends('user.profile')

@section('action')
        <div class="text">
            <h1>User Profile</h1>
        </div>

    <div class="flex justify-center pt-20">
        <form action="/user/{{ $user->id }}/edit/update" method="POST">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div id="edit-formula">
            <div class="form-group">
                 <label class="col-form-label mt-4" for="inputDefault">Name</label>
                 <input type="text" class="form-control" placeholder="name" name = "name" value = {{$user->name}} id="inputDefault" style = "width: 40%;">
            </div>
            <div class="form-group">
                 <label class="col-form-label mt-4" for="inputDefault">Email</label>
                 <input type="text" class="form-control" placeholder="email" name = "email" style = "width: 40%;" value = {{ $user->email}} >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name = "password" style = "width: 40%;" placeholder="Password">
            </div>

                <br><br>
                <button type="submit" class = "btn btn-primary" >
                    Save
                </button>


            </div>
        <!--</form>-->
    </div>

@endsection


