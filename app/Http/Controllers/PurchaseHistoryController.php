<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserOrder;
use App\Models\OrderInformation;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        if(Auth::user() == null){
            return redirect('/home');
        }
        else if(Auth::user() != null && Auth::user()->id != $id)
            return redirect('/home');

        $orders = UserOrder::where('userid', $id)->get();
        return view('user.purchase_history', ['orders' => $orders]);
    }
}
