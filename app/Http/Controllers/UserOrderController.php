<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new UserOrder;

        $order->orderdate = Carbon::now()->toDateTimeString();
        //alterar id e orderid
        $order->orderid = rand(10000000,999999999);
        $order->creditcardid = 1;

        $order->save();
        
    }
    
    public function show($id){
        $order = UserOrder::find($id);

        return view('pages.order', ['order' => $order]);

    }




}
