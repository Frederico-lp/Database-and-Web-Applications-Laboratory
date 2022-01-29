<?php

namespace App\Http\Controllers;

use App\Models\OrderInformation;
use App\Models\UserOrder;
use App\Models\Cart;
use App\Models\BookProduct;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderInformationController extends Controller
{


    public function checkout($id)
    {
        if(Auth::user() == null){
            return redirect('/home');
        }
        else if(Auth::user() != null && Auth::user()->id != $id)
            return redirect('/home');

        //default credit card that user has saved
        $creditCard = CreditCard::where('userid', $id)->get();

        $user = User::find($id);
        
        $bookIds = Cart::where('userid', $id)->get();

        return view('checkout.index', ['bookIds' => $bookIds])->with('creditCard', $creditCard)->with('user', $user); 
    }


    public function confirmedCheckout(Request $request, $id)
    {

        $errors = [];

        //default credit card that user has saved
        $creditCard = CreditCard::where('userid', $id)
        ->where('cardnumber', $request->input('cardNumber'))
        ->first();
        if(!$creditCard){
            array_push($errors, 'Error: Invalid Credit Card');
            $creditCard = CreditCard::where('userid', $id)->get();
        
            $bookIds = Cart::where('userid', $id)->get();

            return back()->with('errors', $errors);
        }

        
        $bookIds = Cart::where('userid', $id)->get();

        $testForNull = Cart::where('userid', $id)->first();
        if($testForNull == null)
            return redirect('/home');



        $orderid = rand(10000000,999999999);
        $userOrder = new UserOrder;
        $userOrder->userid = Auth::user()->id;
        $userOrder->orderdate = Carbon::now()->toDateTimeString();
        //alterar id e orderid
        $userOrder->orderid = $orderid;
        $userOrder->creditcardid = $creditCard->cardid;
        $userOrder->save();
        
        foreach($bookIds as $book){   

            $orderInformation = new OrderInformation;
            $orderInformation->orderid = $orderid;
            $orderInformation->bookid = $book->bookid;
            $orderInformation->pricebought = $book->bookid($book->bookid)->price;
            $orderInformation->orderstatus = 'PROCESSING';
            $orderInformation->quantity = $book->quantity;
            $orderInformation->save();

        }
        
        //to empty cart
        $carts = Cart::where('userid', $id)->get();
        foreach($carts as $cart) {
            $cart->destroy($id, $cart->bookid);
        }

        $url = '/user/'. $userOrder->userid.'/purchase-history';

        return redirect($url);


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderInformation  $orderInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $orderid)
    {
        $orderInformation = OrderInformation::where('orderid', $orderid)->get();

        foreach ($orderInformation as $order) {
            if ($order->orderstatus !== 'PROCESSING') {
                return redirect()->back();
            }
        }
        
        $order = UserOrder::find($orderid);
        $order->delete();

        return redirect()->back();
    }
}
