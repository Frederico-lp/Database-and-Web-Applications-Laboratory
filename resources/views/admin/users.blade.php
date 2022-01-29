@extends('layouts.app')

@section('content')

<br>
<h1> Listing of users</h1>
<br>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">User Type</th>
      <th scope="col">User Status</th>
      <th scope="col">See more</th>

    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)

    <tr >

      <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td> @if ($user->isadmin == "True")
                    ADMIN
                @else
                    USR
                @endif
            </td>
            <td> @if ($user->isblocked == "True")
                    BLOCKED
                @else
                    NORMAL
                @endif
            </td>
            <td> <a class="btn btn-secondary" href="/admin/users/{{$user->id}}">+</a></td>
    </tr>
    @endforeach

  </tbody>

</table>

<br><br>
{{ $users->links() }}

<br><br>

@endsection
