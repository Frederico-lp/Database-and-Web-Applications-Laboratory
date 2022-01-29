<?php

namespace App\Http\Controllers;

use App\Models\BookProduct;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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


        $bookIds = Cart::where('userid', $id)->get();
        return view('cart.index',['bookIds' => $bookIds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cart = new Cart();

        $cart->name = $request->input('quantity');
        $cart->bookId = $request->route('id');
        $cart->save();

        return $cart;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $errors = [];

        $cart = new Cart;
        $userid = Auth::id(); 
        
        $uniqueBook = Cart::where('bookid', '=', $id)
        ->where('userid', '=', $userid)   
        ->first();

        if ($uniqueBook === null) {
            
                    $cart->quantity = $request->input('quantity');
                    $cart->userid = Auth::user()->id;
                    $cart->bookid = $id;
            
                    $cart->save();
            
                    return redirect('/home');
        } 
        array_push($errors, 'Error: Book alredy in cart');
        return redirect()->back()->with('errors', $errors);
        

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::find($id);
        $this->authorize('show', $cart);
        return view('cart.index', ['cart' => $cart]); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $bookid)
    {
        $cart = Cart::where('bookid', '=', $bookid)
        ->where('userid', '=', $id);   //para teste
        //dd($cart);
        $cart->delete();
        return redirect()->back();
    }
}
