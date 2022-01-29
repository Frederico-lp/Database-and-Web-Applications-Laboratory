@extends('layouts.app')


@section('content')

<br>
<br>
<h1> Order information</h1>
<div class = "order"> 
            <div>
                <p1 style="padding-top: 30px;"> Order date:  </p1><p style="padding-top: 30px;">   {{ date('d-m-Y', strtotime($order->orderdate)) }}</p></div>  

                <div><p1> Name associated with payment:  </p1> <p>{{ $order->getCreditCard($order->creditcardid)->ownername }}</p></div> 
               
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">

                <h3> Order content: </h3>
                <div class="cart-books">
                @foreach($order->getOrderInformation($order-> orderid) as $orderInformation)

                <article class="book" >
                
                    <img src="{{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->bookcover }}" width="200" height="250" >
                    <h2> {{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->title}} </h2>
                    <p> Quantity: {{ $orderInformation->quantity }}</p>

                    <form action="/admin/orders/{{$orderInformation->orderid}}/{{$orderInformation->bookid}}/updateStatus" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <label for="exampleSelect1" class="form-label mt-4" form = "update-profile"  ><p2>Order status: </p2></label>
                            <select name = "orderstatus" class="form-select" id="exampleSelect1" style =" width : 200px;">
                                @if ($orderInformation->orderstatus == 'ON TRANSIT')

                                    <option value ='ON TRANSIT' selected = "selected">On transit</option>
                                    <option value = 'PROCESSING' >Processing</option>
                                    <option value = 'ARRIVED' >Arrived</option>

                                @elseif ($orderInformation->orderstatus == "PROCESSING")

                                    <option value ='ON TRANSIT'>On transit</option>
                                    <option value = 'PROCESSING' selected = "selected" >Processing</option>
                                    <option value = 'ARRIVED' >Arrived</option>
                                @elseif ($orderInformation->orderstatus == 'ARRIVED')

                                    <option value ='ON TRANSIT'>On transit</option>
                                    <option value = 'PROCESSING' >Processing</option>
                                    <option value = 'ARRIVED' selected = "selected" >Arrived</option>
                                

                                @endif
                            </select>
                            <br>
                            <br>


                        <button class = "btn btn-primary" type="submit" >
                            Save
                        </button>
                    </form>
                </article>
                @endforeach
                </div>
            </div>
            </div>







@endsection
