@extends('user.profile')

@section('title', 'userInfo')

@section('content')



<h1> Profile</h1>
<br>
<div class= "profile-info" >
    <div class= "photo-name">
        <img src = {{ $user->profilepicture }} width="260" >
        <figcaption>{{ $user->name }} </figcaption>
    </div>
    <div class="space"></div>
    <div class= "information">
        <h1> Account Details: </h1><hr>
        <p2>  Username:</p2> <p3>  {{ $user->name }} </p3><hr>
        <p2>  Email: </p2> <p3>  {{ $user->email }}</p3><hr>

        <form id = "update-profile" action="/admin/user/{{$user->id}}/update" method="POST">
        {{ csrf_field() }}
                {{ method_field('put') }}
            <label for="exampleSelect1" class="form-label mt-4" form = "update-profile"  ><p2>Account status: </p2></label>
                <select  name = "blocked" class="form-select" id="exampleSelect1" style =" width : 200px;">
                    @if ($user->isblocked == 'True')
                        <option value ="False">Normal</option>
                        <option value = "True" selected = "selected">Blocked</option>
                    @else

                        <option value ="False" selected = "selected">Normal</option>
                        <option value = "True" >Blocked</option>
                    @endif
            
                </select>
                <hr>
                <label for="exampleSelect1" class="form-label mt-4"><p2>User type:</p2></label>
                <select name = "admin"class="form-select" id="exampleSelect1" style =" width : 200px;">
                    @if ($user->isadmin == 'True')
                            <option selected = "selected" value = "True">Admin</option>
                            <option value = "False" >Regular</option>
                    @else
                            <option  value = "True">Admin</option>
                            <option selected = "selected" value ="False" >Regular</option>
                    @endif
                
                </select>
                <br><br>
            <button class = "btn btn-primary" type="submit" style = "width: 200px;" >
                    Save
            </button>
            </form> 
    </div>


    </div>

    <br><br><br><br><br><br><br><br><br><br>
    
    <div>


    <h1> Order History</h1>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Date</th>
        <th scope="col">Card Associated</th>
        <th scope="col">See more</th>

        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)

        <tr >

        <th scope="row">{{$order->orderid}}</th>
                <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                <td>{{ $order->getCreditCard($order->creditcardid)->cardnumber }}</td>
                <td> <a class="btn btn-secondary" href="/admin/orders/{{$order->orderid}}">+</a></td>
        </tr>
    @endforeach

    </tbody>
    </table>
<br><br><br><br><br><br>
   




@endsection
